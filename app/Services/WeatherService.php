<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class WeatherService
{
    public function forLocation(?string $location): ?array
    {
        if (!$location) {
            return null;
        }

        return Cache::remember('weather.'.md5(strtolower($location)), now()->addMinutes(30), function () use ($location) {
            $place = Http::timeout(8)
                ->get('https://geocoding-api.open-meteo.com/v1/search', [
                    'name' => $location,
                    'count' => 1,
                    'language' => 'en',
                    'format' => 'json',
                ])
                ->throw()
                ->json('results.0');

            if (!$place) {
                return null;
            }

            $forecast = Http::timeout(8)
                ->get('https://api.open-meteo.com/v1/forecast', [
                    'latitude' => $place['latitude'],
                    'longitude' => $place['longitude'],
                    'current' => 'temperature_2m,precipitation,weather_code,soil_moisture_0_to_1cm',
                    'daily' => 'temperature_2m_max,temperature_2m_min,precipitation_sum,precipitation_probability_max',
                    'forecast_days' => 3,
                    'timezone' => 'auto',
                ])
                ->throw()
                ->json();

            return [
                'place' => $place,
                'current' => $forecast['current'] ?? [],
                'daily' => $forecast['daily'] ?? [],
            ];
        });
    }

    public function irrigationAdvice(?array $weather): ?string
    {
        if (!$weather) {
            return null;
        }

        $todayRain = $weather['daily']['precipitation_sum'][0] ?? 0;
        $rainChance = $weather['daily']['precipitation_probability_max'][0] ?? 0;
        $soilMoisture = $weather['current']['soil_moisture_0_to_1cm'] ?? null;

        if ($todayRain >= 5 || $rainChance >= 70) {
            return 'Rain is likely today, so irrigation can usually be delayed unless field sensors show dry soil.';
        }

        if ($soilMoisture !== null && $soilMoisture < 0.18) {
            return 'Surface soil moisture is low; check your device readings and consider irrigation soon.';
        }

        return 'Weather looks stable; use your IoT moisture readings to decide the next irrigation cycle.';
    }
}