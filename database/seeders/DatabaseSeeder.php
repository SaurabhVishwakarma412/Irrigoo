<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Device;
use App\Models\FarmerDevice;
use App\Models\SensorData;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'System Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_verified' => true,
            'location' => 'Head Office',
        ]);

        // Farmer
        $farmer = User::create([
            'name' => 'John Doe',
            'email' => 'farmer@example.com',
            'password' => Hash::make('password'),
            'role' => 'farmer',
            'is_verified' => true,
            'phone' => '9876543210',
            'location' => 'Pune',
            'crop_type' => 'Sugarcane',
            'organization' => 'Green Valley Farm',
            'address' => 'Pune rural irrigation zone',
        ]);

        $provider = User::create([
            'name' => 'AquaCare Services',
            'email' => 'provider@example.com',
            'password' => Hash::make('password'),
            'role' => 'provider',
            'is_verified' => true,
            'phone' => '9876500000',
            'location' => 'Pune',
            'crop_type' => 'Sugarcane, Rice, Wheat',
            'organization' => 'AquaCare Irrigation Services',
            'address' => 'Pune service center',
        ]);

        // Manufacturer
        $manufacturer = User::create([
            'name' => 'AgriTech IoT',
            'email' => 'mfg@example.com',
            'password' => Hash::make('password'),
            'role' => 'manufacturer',
            'is_verified' => true,
            'phone' => '9876511111',
            'location' => 'Pune',
            'organization' => 'AgriTech IoT',
            'address' => 'Industrial IoT park, Pune',
        ]);

        // Create a Device
        $device = Device::create([
            'manufacturer_id' => $manufacturer->id,
            'name' => 'Smart Soil Sensor Pro',
            'description' => 'Measures moisture, temperature, and water flow.',
            'connectivity' => 'Wi-Fi + GSM',
            'power_source' => 'Solar with battery backup',
            'coverage_area' => 'Up to 5 acres',
            'target_crops' => 'Sugarcane, Rice, Wheat',
            'price' => 199.99,
            'features' => ['soil moisture', 'temperature', 'water flow', 'remote valve control'],
        ]);

        Service::create([
            'provider_id' => $provider->id,
            'name' => 'Smart Drip Irrigation Maintenance',
            'description' => 'Field inspection, valve calibration, pipe leak checks, and sensor alignment.',
            'type' => 'maintenance',
            'service_area' => 'Pune',
            'crop_types' => 'Sugarcane, Rice, Wheat',
            'base_price' => 1499,
        ]);

        // Assign Device to Farmer
        $farmerDevice = FarmerDevice::create([
            'farmer_id' => $farmer->id,
            'device_id' => $device->id,
            'status' => 'active',
            'irrigation_on' => false,
            'installation_date' => now()->subDays(10),
        ]);

        // Generate Simulated Sensor Data
        for ($i = 24; $i >= 0; $i--) {
            SensorData::create([
                'farmer_device_id' => $farmerDevice->id,
                'moisture_level' => rand(20, 80),
                'temperature' => rand(15, 35),
                'water_flow' => rand(0, 10) == 0 ? 0 : rand(1, 5),
                'created_at' => now()->subHours($i),
            ]);
        }
    }
}
