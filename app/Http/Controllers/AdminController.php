<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Device;
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
            'unverified_users' => User::where('is_verified', false)->count(),
        ];

        $users = User::latest()->paginate(10);

        return view('admin.dashboard', compact('stats', 'users'));
    }

    public function verifyUser(User $user)
    {
        $user->update(['is_verified' => true]);
        return back()->with('success', 'User verified successfully.');
    }
}
