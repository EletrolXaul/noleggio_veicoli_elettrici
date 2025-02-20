<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // Aggiungi questo import

class UserDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $activeRentals = Rental::forCurrentUser()
            ->where('status', Rental::STATUS_ACTIVE)
            ->with('vehicle')
            ->get();
        
        $stats = [
            'active_rentals' => Rental::forCurrentUser()
                ->where('status', Rental::STATUS_ACTIVE)
                ->count(),
            'completed_rentals' => Rental::forCurrentUser()
                ->where('status', Rental::STATUS_COMPLETED)
                ->count(),
            'total_spent' => Rental::forCurrentUser()
                ->where('status', Rental::STATUS_COMPLETED)
                ->sum('total_cost')
        ];
                              
        return view('user.dashboard', compact('activeRentals', 'stats'));
    }

    public function rentals()
    {
        $rentals = Rental::where('user_id', Auth::id()) // Modifica qui
                        ->with(['vehicle'])
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);
                        
        return view('user.rentals.index', compact('rentals'));
    }

    public function bookVehicle(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate(Rental::rules());
        
        try {
            return DB::transaction(function() use ($validated, $vehicle) {
                if (!$vehicle->isAvailable()) {
                    throw new \Exception('Questo veicolo non è disponibile.');
                }

                $startTime = Carbon::parse($validated['start_time']);
                $endTime = Carbon::parse($validated['end_time']);
                
                // Controlla sovrapposizioni
                $existingRental = Rental::where('vehicle_id', $vehicle->id)
                    ->where('status', 'active')
                    ->where(function($query) use ($startTime, $endTime) {
                        $query->whereBetween('start_time', [$startTime, $endTime])
                            ->orWhereBetween('end_time', [$startTime, $endTime]);
                    })->exists();

                if ($existingRental) {
                    throw new \Exception('Il veicolo è già prenotato in questo periodo.');
                }

                $hours = $endTime->diffInHours($startTime);
                $totalCost = $hours * $vehicle->hourly_rate;

                $rental = Rental::create([
                    'vehicle_id' => $vehicle->id,
                    'user_id' => Auth::id(), // Modifica qui
                    'start_time' => $startTime,
                    'end_time' => $endTime,
                    'total_cost' => $totalCost,
                    'status' => 'active'
                ]);

                $vehicle->update(['status' => 'rented']);
                
                return redirect()->route('user.rentals')->with('success', 'Noleggio effettuato con successo!');
            });
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function showRental(Rental $rental)
    {
        if ($rental->user_id !== Auth::id()) { // Modifica qui
            abort(403);
        }

        return view('user.rentals.show', compact('rental'));
    }
}