<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'model',
        'type',
        'battery_capacity',
        'status',
        'hourly_rate'
    ];

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
