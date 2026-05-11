<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $guarded = [];

    public function farmer()
    {
        return $this->belongsTo(User::class, 'farmer_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
