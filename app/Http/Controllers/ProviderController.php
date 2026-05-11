<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index()
    {
        $services = Service::where('provider_id', auth()->id())->latest()->get();

        $serviceRequests = ServiceRequest::with(['farmer', 'service'])
            ->whereHas('service', function ($query) {
                $query->where('provider_id', auth()->id());
            })
            ->latest()
            ->get();

        return view('provider.dashboard', compact('services', 'serviceRequests'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:installation,maintenance,repair,consultation'],
            'description' => ['nullable', 'string', 'max:1000'],
            'service_area' => ['required', 'string', 'max:255'],
            'crop_types' => ['nullable', 'string', 'max:255'],
            'base_price' => ['nullable', 'numeric', 'min:0'],
        ]);

        $data['provider_id'] = auth()->id();

        Service::create($data);

        return back()->with('success', 'Irrigation service published.');
    }

    public function updateRequest(Request $request, ServiceRequest $serviceRequest)
    {
        abort_unless($serviceRequest->service->provider_id === auth()->id(), 403);

        $data = $request->validate([
            'status' => ['required', 'in:pending,accepted,completed,rejected'],
        ]);

        $serviceRequest->update($data);

        return back()->with('success', 'Service request updated.');
    }
}
