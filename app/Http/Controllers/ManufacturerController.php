<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Service;
use App\Models\DevicePurchase;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    public function index()
    {
        $devices = Device::where('manufacturer_id', auth()->id())->latest()->get();
        $availableServices = Service::with('provider')->latest()->get();
        $sales = DevicePurchase::with(['provider', 'device'])
            ->whereHas('device', fn ($query) => $query->where('manufacturer_id', auth()->id()))
            ->latest()
            ->get();
        $totalEarnings = $sales->sum('total_price');

        return view('manufacturer.dashboard', compact('devices', 'availableServices', 'sales', 'totalEarnings'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'connectivity' => ['required', 'string', 'max:255'],
            'power_source' => ['required', 'string', 'max:255'],
            'coverage_area' => ['nullable', 'string', 'max:255'],
            'target_crops' => ['nullable', 'string', 'max:255'],
            'features' => ['nullable', 'string', 'max:1000'],
        ]);

        $data['manufacturer_id'] = auth()->id();
        $data['features'] = collect(explode(',', $request->features ?? ''))
            ->map(fn ($feature) => trim($feature))
            ->filter()
            ->values()
            ->all();

        Device::create($data);

        return back()->with('success', 'IoT irrigation solution added.');
    }
}
