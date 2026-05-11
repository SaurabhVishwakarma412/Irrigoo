<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = [];

    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    public function requests()
    {
        return $this->hasMany(ServiceRequest::class);
    }
}
