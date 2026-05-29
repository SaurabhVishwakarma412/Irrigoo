<?php

namespace App\Http\Controllers;

use App\Models\FarmerDevice;
use App\Models\Device;
use App\Models\DevicePurchase;
use App\Models\Service;
use App\Models\ServiceRequest;
use App\Services\WeatherService;
use Illuminate\Http\Request;

class FarmerController extends Controller
{
    public function index(WeatherService $weatherService)
    {
        $farmerDevices = FarmerDevice::where('farmer_id', auth()->id())
            ->with(['device', 'sensorData' => function($q) {
                $q->latest()->take(24);
            }])
            ->get();

        $farmer = auth()->user();
        $availableDevices = Device::with('manufacturer')->latest()->get();
        $devicePurchases = DevicePurchase::with('device.manufacturer')
            ->where('farmer_id', auth()->id())
            ->latest()
            ->take(5)
            ->get();

        $services = Service::with('provider')
            ->when($farmer->location, function ($query, $location) {
                $query->where(function ($subQuery) use ($location) {
                    $subQuery->where('service_area', 'like', "%{$location}%")
                        ->orWhereHas('provider', function ($providerQuery) use ($location) {
                            $providerQuery->where('location', 'like', "%{$location}%");
                        });
                });
            })
            ->when($farmer->crop_type, function ($query, $cropType) {
                $query->where(function ($subQuery) use ($cropType) {
                    $subQuery->whereNull('crop_types')
                        ->orWhere('crop_types', 'like', "%{$cropType}%");
                });
            })
            ->latest()
            ->take(6)
            ->get();

        $serviceRequests = ServiceRequest::with(['service.provider'])
            ->where('farmer_id', auth()->id())
            ->latest()
            ->take(5)
            ->get();

        $waterUsage = $farmerDevices->sum(function ($farmerDevice) {
            return $farmerDevice->sensorData->sum('water_flow');
        });

        try {
            $weather = $weatherService->forLocation($farmer->location);
            $irrigationAdvice = $weatherService->irrigationAdvice($weather);
        } catch (\Throwable $exception) {
            $weather = null;
            $irrigationAdvice = null;
        }

        return view('farmer.dashboard', compact('farmerDevices', 'availableDevices', 'devicePurchases', 'services', 'serviceRequests', 'waterUsage', 'weather', 'irrigationAdvice'));
    }

    public function toggleIrrigation(Request $request, FarmerDevice $farmerDevice)
    {
        if ($farmerDevice->farmer_id !== auth()->id()) {
            abort(403);
        }

        $farmerDevice->update([
            'irrigation_on' => !$farmerDevice->irrigation_on
        ]);

        return response()->json([
            'status' => 'success',
            'irrigation_on' => $farmerDevice->irrigation_on
        ]);
    }

    public function requestService(Request $request, Service $service)
    {
        $request->validate([
            'scheduled_date' => ['nullable', 'date'],
        ]);

        ServiceRequest::create([
            'farmer_id' => auth()->id(),
            'service_id' => $service->id,
            'status' => 'pending',
            'scheduled_date' => $request->scheduled_date,
        ]);

        return back()->with('success', 'Service request sent to the provider.');
    }

    public function purchaseDevice(Request $request, Device $device)
    {
        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $unitPrice = $device->price ?? 0;
        $purchase = DevicePurchase::create([
            'farmer_id' => auth()->id(),
            'device_id' => $device->id,
            'quantity' => $data['quantity'],
            'unit_price' => $unitPrice,
            'total_price' => $unitPrice * $data['quantity'],
            'payment_status' => 'paid',
        ]);

        FarmerDevice::firstOrCreate(
            [
                'farmer_id' => auth()->id(),
                'device_id' => $device->id,
            ],
            [
                'status' => 'purchased',
                'irrigation_on' => false,
            ]
        );

        return back()->with('success', 'Product purchased successfully. Payment recorded for order #'.$purchase->id.'.');
    }
}
