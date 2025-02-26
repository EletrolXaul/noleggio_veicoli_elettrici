<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Vehicle;
use App\Notifications\RentalConfirmationNotification;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        $validated = $request->validate(Rental::rules($request->all()));

        try {
            return DB::transaction(function () use ($validated, $vehicle) {
                if (!$vehicle->isAvailable()) {
                    throw new \Exception('Questo veicolo non è disponibile.');
                }

                $startTime = Carbon::parse($validated['start_time']);
                $endTime = Carbon::parse($validated['end_time']);

                // Debug per verificare che le date siano correttamente parsate
                // Log::info("Start time: " . $startTime->toDateTimeString());
                // Log::info("End time: " . $endTime->toDateTimeString());

                // Verifica sovrapposizioni
                if ($vehicle->hasOverlappingRentals($startTime, $endTime)) {
                    throw new \Exception('Il veicolo è già prenotato in questo periodo.');
                }

                // Verifica durata minima e massima
                if ($endTime->lt($startTime->copy()->addHour())) {
                    throw new \Exception('La durata minima del noleggio è di 1 ora.');
                }

                if ($endTime->gt($startTime->copy()->addDays(180))) { // 180 giorni (6 mesi)
                    throw new \Exception('La durata massima del noleggio è di 180 giorni.');
                }

                // Calcola le ore per il costo totale
                $hours = $endTime->diffInHours($startTime, false);
                if ($hours <= 0) {
                    $hours = 1; // Minimo un'ora per il calcolo del costo
                }

                $totalCost = $hours * $vehicle->hourly_rate;

                $rental = Rental::create([
                    'vehicle_id' => $vehicle->id,
                    'user_id' => Auth::id(),
                    'start_time' => $startTime,
                    'end_time' => $endTime,
                    'total_cost' => $totalCost,
                    'status' => Rental::STATUS_ACTIVE
                ]);

                // Invia notifica di conferma
                $user = Auth::user();
                $user->notify(new RentalConfirmationNotification($rental));
                $vehicle->update(['status' => 'rented']);

                // Usa la variabile $rental in qualche modo
                return redirect()->route('user.rentals')
                    ->with('success', 'Noleggio #' . $rental->id . ' effettuato con successo!');
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
