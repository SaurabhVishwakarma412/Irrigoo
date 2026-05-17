<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FarmerDevice extends Model
{
    protected $guarded = [];

    protected $casts = [
        'irrigation_on' => 'boolean',
        'installation_date' => 'date',
    ];

    public function farmer()
    {
        return $this->belongsTo(User::class, 'farmer_id');
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function sensorData()
    {
        return $this->hasMany(SensorData::class);
    }
}
