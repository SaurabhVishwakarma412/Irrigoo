<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Device;
use App\Models\FarmerDevice;
use App\Models\SensorData;
use App\Models\Service;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_devices' => Device::count(),
            'total_services' => Service::count(),
            'total_requests' => ServiceRequest::count(),
            'total_readings' => SensorData::count(),
            'assigned_devices' => FarmerDevice::count(),
        ];

        $users = User::latest()->paginate(10);
        $farmers = User::where('role', 'farmer')->orderBy('name')->get();
        $devices = Device::with('manufacturer')->latest()->get();
        $assignments = FarmerDevice::with(['farmer', 'device.manufacturer'])->latest()->take(8)->get();

        return view('admin.dashboard', compact('stats', 'users', 'farmers', 'devices', 'assignments'));
    }

    public function assignDevice(Request $request)
    {
        $data = $request->validate([
            'farmer_id' => ['required', 'string'],
            'device_id' => ['required', 'string'],
            'installation_date' => ['nullable', 'date'],
        ]);

        $farmer = User::findOrFail($data['farmer_id']);
        Device::findOrFail($data['device_id']);
        abort_unless($farmer->role === 'farmer', 422);

        FarmerDevice::updateOrCreate(
            [
                'farmer_id' => $data['farmer_id'],
                'device_id' => $data['device_id'],
            ],
            [
                'status' => 'active',
                'installation_date' => $data['installation_date'] ?? now()->toDateString(),
            ]
        );

        return back()->with('success', 'Device assigned to farmer successfully.');
    }

    public function verifyUser(User $user)
    {
        $user->update([
            'is_verified' => true,
            'verified_by' => auth()->id(),
            'verified_at' => now(),
        ]);

        return back()->with('success', 'User verified successfully.');
    }
}
