<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Device;
use App\Models\DevicePurchase;
use App\Models\FarmerProfile;
use App\Models\FarmerDevice;
use App\Models\ManufacturerProfile;
use App\Models\ProviderProfile;
use App\Models\SensorData;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create Sample Provider
        $provider = User::updateOrCreate(['email' => 'provider@example.com'], [
            'name' => 'Sample Provider',
            'email' => 'provider@example.com',
            'password' => Hash::make('password'),
            'role' => 'provider',
            'is_verified' => true,
        ]);
        
        ProviderProfile::updateOrCreate(['user_id' => $provider->id], [
            'organization' => 'Sample Provider Services',
            'location' => 'Pune, Maharashtra',
            'service_area' => 'Pune, Maharashtra',
        ]);

        // Create Sample Farmer
        $farmer = User::updateOrCreate(['email' => 'farmer@example.com'], [
            'name' => 'Sample Farmer',
            'email' => 'farmer@example.com',
            'password' => Hash::make('password'),
            'role' => 'farmer',
            'is_verified' => true,
        ]);

        FarmerProfile::updateOrCreate(['user_id' => $farmer->id], [
            'farm_name' => 'Sample Farm',
            'location' => 'Satara, Maharashtra',
            'crop_type' => 'Sugarcane',
            'farm_size' => 5.5,
        ]);

        $manufacturer = User::updateOrCreate(['email' => 'manufacturer@example.com'], [
            'name' => 'Sample Manufacturer',
            'email' => 'manufacturer@example.com',
            'password' => Hash::make('password'),
            'role' => 'manufacturer',
            'is_verified' => true,
        ]);
        ManufacturerProfile::updateOrCreate(['user_id' => $manufacturer->id], [
            'organization' => 'AgriTech IoT',
            'location' => 'Pune, Maharashtra',
        ]);

        $device = Device::updateOrCreate(
            ['manufacturer_id' => $manufacturer->id, 'name' => 'Smart Soil Sensor Pro'],
            [
                'description' => 'Measures moisture, temperature, and water flow.',
                'connectivity' => 'Wi-Fi + GSM',
                'power_source' => 'Solar with battery backup',
                'coverage_area' => 'Up to 5 acres',
                'target_crops' => 'Sugarcane, Rice, Wheat',
                'price' => 199.99,
                'features' => ['soil moisture', 'temperature', 'water flow', 'remote valve control'],
            ]
        );

        Service::updateOrCreate(
            ['provider_id' => $provider->id, 'name' => 'Smart Drip Irrigation Maintenance'],
            [
                'description' => 'Field inspection, valve calibration, pipe leak checks, and sensor alignment.',
                'type' => 'maintenance',
                'service_area' => 'Pune, Maharashtra',
                'crop_types' => 'Sugarcane, Rice, Wheat',
                'base_price' => 1499,
            ]
        );

        Service::updateOrCreate(
            ['provider_id' => $provider->id, 'name' => 'Sensor Calibration Visit'],
            [
                'description' => 'Moisture, water-flow, and valve sensor calibration for installed irrigation devices.',
                'type' => 'sensor_calibration',
                'service_area' => 'Satara, Maharashtra',
                'crop_types' => 'Sugarcane, Rice, Wheat',
                'base_price' => 799,
            ]
        );

        DevicePurchase::updateOrCreate(
            ['farmer_id' => $farmer->id, 'device_id' => $device->id],
            [
                'quantity' => 1,
                'unit_price' => $device->price ?? 0,
                'total_price' => $device->price ?? 0,
                'payment_status' => 'paid',
            ]
        );

        $farmerDevice = FarmerDevice::updateOrCreate(
            ['farmer_id' => $farmer->id, 'device_id' => $device->id],
            [
                'status' => 'active',
                'irrigation_on' => false,
                'installation_date' => now()->subDays(10)->toDateString(),
            ]
        );

        if ($farmerDevice->sensorData()->count() === 0) {
            for ($i = 24; $i >= 0; $i--) {
                SensorData::create([
                    'farmer_device_id' => $farmerDevice->id,
                    'moisture_level' => rand(20, 80),
                    'temperature' => rand(15, 35),
                    'water_flow' => rand(0, 10) === 0 ? 0 : rand(1, 5),
                    'created_at' => now()->subHours($i),
                ]);
            }
        }
    }
}
