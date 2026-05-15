<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\Api\SensorDataController;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (!auth()->user()->is_verified && auth()->user()->role !== 'admin') {
            return view('pending-verification');
        }

        $role = auth()->user()->role;
        if ($role === 'admin') return redirect()->route('admin.dashboard');
        if ($role === 'farmer') return redirect()->route('farmer.dashboard');
        if ($role === 'provider') return redirect()->route('provider.dashboard');
        if ($role === 'manufacturer') return redirect()->route('manufacturer.dashboard');
        return view('dashboard');
    })->name('dashboard');

    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::post('/users/{user}/verify', [AdminController::class, 'verifyUser'])->name('users.verify');
        Route::post('/device-assignments', [AdminController::class, 'assignDevice'])->name('device-assignments.store');
    });

    Route::middleware(['role:farmer'])->prefix('farmer')->name('farmer.')->group(function () {
        Route::get('/dashboard', [FarmerController::class, 'index'])->name('dashboard');
        Route::post('/devices/{farmerDevice}/toggle-irrigation', [FarmerController::class, 'toggleIrrigation'])->name('devices.toggle');
        Route::post('/services/{service}/request', [FarmerController::class, 'requestService'])->name('services.request');
        Route::get('/api/sensors/{farmerDevice}', [SensorDataController::class, 'fetch'])->name('api.sensors.fetch');
        Route::post('/api/sensors/{farmerDevice}/simulate', [SensorDataController::class, 'simulate'])->name('api.sensors.simulate');
    });

    Route::middleware(['role:provider'])->prefix('provider')->name('provider.')->group(function () {
        Route::get('/dashboard', [ProviderController::class, 'index'])->name('dashboard');
        Route::post('/services', [ProviderController::class, 'store'])->name('services.store');
        Route::patch('/requests/{serviceRequest}', [ProviderController::class, 'updateRequest'])->name('requests.update');
    });

    Route::middleware(['role:manufacturer'])->prefix('manufacturer')->name('manufacturer.')->group(function () {
        Route::get('/dashboard', [ManufacturerController::class, 'index'])->name('dashboard');
        Route::post('/devices', [ManufacturerController::class, 'store'])->name('devices.store');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

require __DIR__.'/auth.php';
