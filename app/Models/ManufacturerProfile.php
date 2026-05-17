<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManufacturerProfile extends Model
{
    protected $fillable = [
        'user_id',
        'organization',
        'phone',
        'location',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
