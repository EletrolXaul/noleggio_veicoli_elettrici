<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

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

    public function isAvailable($startTime = null, $endTime = null): bool
    {
        // Se il veicolo è in manutenzione, non è disponibile
        if ($this->status === self::STATUS_MAINTENANCE) {
            return false;
        }
        
        // Se non vengono specificate le date, controlla solo se non è in manutenzione
        if ($startTime === null || $endTime === null) {
            return true;
        }
        
        // Verifica se ci sono sovrapposizioni con altri noleggi attivi
        return !$this->hasOverlappingRentals($startTime, $endTime);
    }

    public function activeRentals(): HasMany
    {
        return $this->rentals()->where('status', Rental::STATUS_ACTIVE);
    }

    // Controlla sovrapposizioni noleggi
    public function hasOverlappingRentals($startTime, $endTime): bool
    {
        $startDateTime = Carbon::parse($startTime);
        $endDateTime = Carbon::parse($endTime);
        
        return $this->rentals()
            ->where('status', Rental::STATUS_ACTIVE)
            ->where(function($query) use ($startDateTime, $endDateTime) {
                // Controlla se c'è sovrapposizione:
                // - Inizio del nuovo noleggio è tra inizio e fine di un noleggio esistente
                // - Fine del nuovo noleggio è tra inizio e fine di un noleggio esistente
                // - Il nuovo noleggio copre completamente un noleggio esistente
                $query->where(function($q) use ($startDateTime, $endDateTime) {
                    // Il nuovo noleggio inizia durante un noleggio esistente
                    $q->where('start_time', '<=', $startDateTime)
                      ->where('end_time', '>=', $startDateTime);
                })->orWhere(function($q) use ($startDateTime, $endDateTime) {
                    // Il nuovo noleggio finisce durante un noleggio esistente
                    $q->where('start_time', '<=', $endDateTime)
                      ->where('end_time', '>=', $endDateTime);
                })->orWhere(function($q) use ($startDateTime, $endDateTime) {
                    // Il nuovo noleggio copre completamente un noleggio esistente
                    $q->where('start_time', '>=', $startDateTime)
                      ->where('end_time', '<=', $endDateTime);
                });
            })->exists();
    }
}
