<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DevicePurchase extends Model
{
    protected $fillable = [
        'provider_id',
        'device_id',
        'quantity',
        'unit_price',
        'total_price',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
