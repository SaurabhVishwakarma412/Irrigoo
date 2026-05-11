<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $guarded = [];

    protected $casts = [
        'features' => 'array',
    ];

    public function manufacturer()
    {
        return $this->belongsTo(User::class, 'manufacturer_id');
    }

    public function farmerDevices()
    {
        return $this->hasMany(FarmerDevice::class);
    }
}
