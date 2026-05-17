<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\SensorDataController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProviderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : view('welcome');
})->name('home');

Route::middleware('auth')->group(function (): void {
    Route::get('/dashboard', function () {
        $user = auth()->user();

        return match ($user->role) {
            'admin' => app(AdminController::class)->index(),
            'farmer' => app(FarmerController::class)->index(app(\App\Services\WeatherService::class)),
            'provider' => app(ProviderController::class)->index(),
            'manufacturer' => app(ManufacturerController::class)->index(),
            default => view('dashboard'),
        };
    })->name('dashboard');

    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function (): void {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::post('/device-assignments', [AdminController::class, 'assignDevice'])->name('device-assignments.store');
        Route::post('/users/{user}/verify', [AdminController::class, 'verifyUser'])->name('users.verify');
    });

    Route::middleware('role:farmer')->prefix('farmer')->name('farmer.')->group(function (): void {
        Route::get('/dashboard', [FarmerController::class, 'index'])->name('dashboard');
        Route::post('/devices/{farmerDevice}/toggle-irrigation', [FarmerController::class, 'toggleIrrigation'])->name('devices.toggle');
        Route::post('/services/{service}/request', [FarmerController::class, 'requestService'])->name('services.request');
        Route::get('/api/sensors/{farmerDevice}', [SensorDataController::class, 'fetch'])->name('api.sensors.fetch');
        Route::post('/api/sensors/{farmerDevice}/simulate', [SensorDataController::class, 'simulate'])->name('api.sensors.simulate');
    });

    Route::middleware('role:provider')->prefix('provider')->name('provider.')->group(function (): void {
        Route::get('/dashboard', [ProviderController::class, 'index'])->name('dashboard');
        Route::get('/purchases', [ProviderController::class, 'purchases'])->name('purchases.index');
        Route::post('/devices/{device}/purchase', [ProviderController::class, 'purchase'])->name('devices.purchase');
        Route::post('/services', [ProviderController::class, 'store'])->name('services.store');
        Route::delete('/services/{service}', [ProviderController::class, 'destroy'])->name('services.destroy');
        Route::patch('/requests/{serviceRequest}', [ProviderController::class, 'updateRequest'])->name('requests.update');
    });

    Route::middleware('role:manufacturer')->prefix('manufacturer')->name('manufacturer.')->group(function (): void {
        Route::get('/dashboard', [ManufacturerController::class, 'index'])->name('dashboard');
        Route::post('/devices', [ManufacturerController::class, 'store'])->name('devices.store');
    });

});

Route::middleware('auth')->group(function (): void {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

require __DIR__.'/auth.php';


