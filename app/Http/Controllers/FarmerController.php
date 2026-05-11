<?php

namespace App\Http\Controllers;

use App\Models\FarmerDevice;
use App\Models\Service;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FarmerController extends Controller
{
    public function index()
    {
        $farmerDevices = FarmerDevice::where('farmer_id', auth()->id())
            ->with(['device', 'sensorData' => function($q) {
                $q->latest()->take(24);
            }])
            ->get();

        $farmer = auth()->user();

        $services = Service::with('provider')
            ->whereHas('provider', function ($query) {
                $query->where('is_verified', true);
            })
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

        return view('farmer.dashboard', compact('farmerDevices', 'services', 'serviceRequests', 'waterUsage'));
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
}
