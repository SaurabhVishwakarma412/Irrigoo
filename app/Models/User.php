<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
        'city',
        'state',
        'pincode',
        'latitude',
        'longitude',
        'location',
        'crop_type',
        'organization',
        'farm_size',
        'is_verified',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_verified' => 'boolean',
        'password' => 'hashed',
    ];

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'provider_id');
    }

    public function farmerProfile()
    {
        return $this->hasOne(FarmerProfile::class);
    }

    public function providerProfile()
    {
        return $this->hasOne(ProviderProfile::class);
    }

    public function manufacturerProfile()
    {
        return $this->hasOne(ManufacturerProfile::class);
    }

    public function farmerDevices()
    {
        return $this->hasMany(FarmerDevice::class, 'farmer_id');
    }

    public function manufacturedDevices()
    {
        return $this->hasMany(Device::class, 'manufacturer_id');
    }

    public function devicePurchases()
    {
        return $this->hasMany(DevicePurchase::class, 'farmer_id');
    }

    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class, 'farmer_id');
    }

    public function getPhoneAttribute($value)
    {
        return $value
            ?? $this->farmerProfile?->phone
            ?? $this->providerProfile?->phone
            ?? $this->manufacturerProfile?->phone;
    }

    public function getLocationAttribute($value)
    {
        return $value
            ?? $this->farmerProfile?->location
            ?? $this->providerProfile?->location
            ?? $this->manufacturerProfile?->location;
    }

    public function getCropTypeAttribute($value)
    {
        return $value ?? $this->farmerProfile?->crop_type;
    }

    public function getOrganizationAttribute($value)
    {
        return $value
            ?? $this->providerProfile?->organization
            ?? $this->manufacturerProfile?->organization
            ?? $this->farmerProfile?->farm_name;
    }
}
