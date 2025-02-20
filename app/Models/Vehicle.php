<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    protected $fillable = [
        'model',
        'type',
        'battery_capacity',
        'status',
        'hourly_rate'
    ];

    protected $casts = [
        'battery_capacity' => 'integer',
        'hourly_rate' => 'decimal:2'
    ];

    // Costanti per gli stati
    public const STATUS_AVAILABLE = 'available';
    public const STATUS_RENTED = 'rented';
    public const STATUS_MAINTENANCE = 'maintenance';

    public function rentals(): HasMany
    {
        return $this->hasMany(Rental::class);
    }

    public function isAvailable(): bool
    {
        return $this->status === self::STATUS_AVAILABLE;
    }

    public function activeRentals(): HasMany
    {
        return $this->rentals()->where('status', Rental::STATUS_ACTIVE);
    }

    // Controlla sovrapposizioni noleggi
    public function hasOverlappingRentals($startTime, $endTime): bool
    {
        return $this->rentals()
            ->where('status', Rental::STATUS_ACTIVE)
            ->where(function($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                    ->orWhereBetween('end_time', [$startTime, $endTime]);
            })->exists();
    }
}
