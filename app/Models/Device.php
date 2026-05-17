<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Device extends Model
{
    protected $guarded = [];

    protected $casts = [
        'features' => 'array',
    ];

    protected static function booted(): void
    {
        static::creating(function (Device $device): void {
            $device->serial_number ??= 'DEV-'.Str::upper(Str::random(10));
        });
    }

    public function manufacturer()
    {
        return $this->belongsTo(User::class, 'manufacturer_id');
    }

    public function farmerDevices()
    {
        return $this->hasMany(FarmerDevice::class);
    }
}

