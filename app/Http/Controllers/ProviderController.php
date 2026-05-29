<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $services = Service::where('provider_id', $user->id)->latest()->get();
        
        $serviceRequests = ServiceRequest::whereHas('service', function($query) use ($user) {
            $query->where('provider_id', $user->id);
        })->with(['farmer', 'service'])->latest()->get();
        
        $totalServices = $services->count();
        $pendingRequests = $serviceRequests->where('status', 'pending')->count();
        $completedJobs = $serviceRequests->where('status', 'completed')->count();
        $totalEarnings = $serviceRequests->where('status', 'completed')->sum('final_price');
        
        $recentCompleted = $serviceRequests->where('status', 'completed')->take(5);
        
        return view('provider.dashboard', compact(
            'services', 
            'serviceRequests', 
            'totalServices',
            'pendingRequests', 
            'completedJobs', 
            'totalEarnings',
            'recentCompleted',
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:installation,repair,maintenance,sensor_calibration',
            'service_area' => 'required|string|max:255',
            'crop_types' => 'nullable|string',
            'base_price' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $validated['provider_id'] = auth()->id();
        
        Service::create($validated);

        return redirect()->route('dashboard')->with('success', 'Service published successfully!');
    }

    public function destroy(Service $service)
    {
        if ($service->provider_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized action.');
        }

        $service->delete();
        return redirect()->route('dashboard')->with('success', 'Service deleted successfully.');
    }

    public function updateRequest(Request $request, ServiceRequest $serviceRequest)
    {
        $serviceRequest->loadMissing('service');

        if (! $serviceRequest->service || $serviceRequest->service->provider_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized action.');
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,accepted,completed,rejected',
            'scheduled_date' => 'nullable|date|after_or_equal:today',
        ]);

        $oldStatus = $serviceRequest->status;

        if ($validated['status'] === 'completed' && $serviceRequest->final_price === null) {
            $validated['final_price'] = $serviceRequest->service->base_price ?? 0;
            $validated['payment_status'] = 'paid';
        }

        $serviceRequest->update($validated);

        // You can add notification logic here
        if ($oldStatus !== $validated['status']) {
            // Send notification to farmer about status change
            // This would require a Notification system
        }

        $message = 'Service request updated successfully.';
        
        return redirect()->route('dashboard')->with('success', $message);
    }
}

