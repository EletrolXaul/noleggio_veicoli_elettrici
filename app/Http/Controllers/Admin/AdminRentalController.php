<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminRentalController extends Controller
{
    public function index(Request $request)
    {
        $query = Rental::with(['user', 'vehicle'])
                      ->orderBy('created_at', 'desc');

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('start_date')) {
            $query->whereDate('start_time', '>=', $request->start_date);
        }

        if ($request->has('end_date')) {
            $query->whereDate('end_time', '<=', $request->end_date);
        }

        $rentals = $query->paginate(10);

        return view('admin.rentals.index', compact('rentals'));
    }

    public function create()
    {
        $vehicles = Vehicle::where('status', 'available')->get();
        $users = User::where('role', 'user')->get();
        
        return view('admin.rentals.create', compact('vehicles', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'user_id' => 'required|exists:users,id',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
        ]);

        $vehicle = Vehicle::findOrFail($validated['vehicle_id']);
        
        if (!$vehicle->isAvailable()) {
            return back()->with('error', 'Veicolo non disponibile');
        }

        $startTime = Carbon::parse($validated['start_time']);
        $endTime = Carbon::parse($validated['end_time']);
        $hours = $endTime->diffInHours($startTime);
        $totalCost = $hours * $vehicle->hourly_rate;

        $rental = Rental::create([
            'vehicle_id' => $vehicle->id,
            'user_id' => $validated['user_id'],
            'start_time' => $startTime,
            'end_time' => $endTime,
            'total_cost' => $totalCost,
            'status' => 'active'
        ]);

        $vehicle->update(['status' => 'rented']);

        return redirect()->route('admin.rentals.index')
                        ->with('success', 'Noleggio creato con successo');
    }

    public function show(Rental $rental)
    {
        $rental->load(['user', 'vehicle']);
        return view('admin.rentals.show', compact('rental'));
    }

    public function complete(Rental $rental)
    {
        if ($rental->status !== 'active') {
            return back()->with('error', 'Questo noleggio non può essere completato');
        }

        $rental->update(['status' => 'completed']);
        $rental->vehicle->update(['status' => 'available']);

        return back()->with('success', 'Noleggio completato con successo');
    }

    public function cancel(Rental $rental)
    {
        if ($rental->status !== 'active') {
            return back()->with('error', 'Questo noleggio non può essere cancellato');
        }

        $rental->update(['status' => 'cancelled']);
        $rental->vehicle->update(['status' => 'available']);

        return back()->with('success', 'Noleggio cancellato con successo');
    }
}
