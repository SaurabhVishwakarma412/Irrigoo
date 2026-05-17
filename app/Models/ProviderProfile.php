<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProviderProfile extends Model
{
    protected $fillable = [
        'user_id',
        'organization',
        'phone',
        'location',
        'service_area',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
