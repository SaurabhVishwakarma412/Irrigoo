<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorData extends Model
{
    protected $guarded = [];

    public function farmerDevice()
    {
        return $this->belongsTo(FarmerDevice::class);
    }
}
