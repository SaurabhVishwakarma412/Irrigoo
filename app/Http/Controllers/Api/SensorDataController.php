<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FarmerDevice;
use App\Models\SensorData;
use Illuminate\Http\Request;

class SensorDataController extends Controller
{
    public function simulate(Request $request, FarmerDevice $farmerDevice)
    {
        // Simple manual simulation endpoint
        $moisture = rand(10, 90);
        $temperature = rand(15, 40);
        $waterFlow = $farmerDevice->irrigation_on ? rand(2, 6) : 0;

        $sensorData = SensorData::create([
            'farmer_device_id' => $farmerDevice->id,
            'moisture_level' => $moisture,
            'temperature' => $temperature,
            'water_flow' => $waterFlow,
        ]);

        // Simple Automation Logic
        if ($moisture < 30 && !$farmerDevice->irrigation_on) {
            $farmerDevice->update(['irrigation_on' => true]);
        } elseif ($moisture > 70 && $farmerDevice->irrigation_on) {
            $farmerDevice->update(['irrigation_on' => false]);
        }

        return response()->json([
            'status' => 'success',
            'data' => $sensorData,
            'irrigation_on' => $farmerDevice->fresh()->irrigation_on
        ]);
    }

    public function fetch(FarmerDevice $farmerDevice)
    {
        $data = SensorData::where('farmer_device_id', $farmerDevice->id)
            ->latest()
            ->take(24)
            ->get();

        return response()->json($data);
    }
}
