<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FarmerProfile extends Model
{
    protected $fillable = [
        'user_id',
        'farm_name',
        'phone',
        'location',
        'crop_type',
        'farm_size',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
