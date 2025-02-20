<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Rental extends Model
{
    protected $fillable = [
        'vehicle_id',
        'user_id',
        'start_time',
        'end_time',
        'total_cost',
        'status'
    ];

    public const STATUS_ACTIVE = 'active';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'total_cost' => 'decimal:2'
    ];

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function scopeForCurrentUser($query)
    {
        return $query->where('user_id', Auth::id());
    }

    public static function rules(): array
    {
        return [
            'start_time' => ['required', 'date', 'after:now'],
            'end_time' => ['required', 'date', 'after:start_time', 'before:start_time +1 month'],
            'vehicle_id' => ['required', 'exists:vehicles,id'],
            'user_id' => ['required', 'exists:users,id']
        ];
    }

    // Calcola il costo totale
    public static function calculateCost($startTime, $endTime, $hourlyRate): float
    {
        return Carbon::parse($startTime)->diffInHours(Carbon::parse($endTime)) * $hourlyRate;
    }
}
