<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DevicePurchase extends Model
{
    protected $fillable = [
        'farmer_id',
        'device_id',
        'quantity',
        'unit_price',
        'total_price',
        'payment_status',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    public function farmer()
    {
        return $this->belongsTo(User::class, 'farmer_id');
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
