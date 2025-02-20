<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Vehicle;
use App\Models\Customer;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index(Request $request)
    {
        $query = Rental::query();
        
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->has('start_date')) {
            $query->whereDate('start_time', '>=', $request->start_date);
        }
        
        if ($request->has('end_date')) {
            $query->whereDate('end_time', '<=', $request->end_date);
        }
        
        $rentals = $query->with(['vehicle', 'customer'])->paginate(10);
        return view('rentals.index', compact('rentals'));
    }

    public function create()
    {
        $vehicles = Vehicle::where('status', 'available')->get();
        $customers = Customer::all();
        return view('rentals.create', compact('vehicles', 'customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'customer_id' => 'required|exists:customers,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time'
        ]);

        $vehicle = Vehicle::find($validated['vehicle_id']);
        $hours = now()->diffInHours($validated['end_time']);
        $validated['total_cost'] = $vehicle->hourly_rate * $hours;
        $validated['status'] = 'active';

        Rental::create($validated);
        $vehicle->update(['status' => 'rented']);

        return redirect()->route('rentals.index')->with('success', 'Noleggio creato con successo');
    }

    public function show(Rental $rental)
    {
        return view('rentals.show', compact('rental'));
    }

    public function edit(Rental $rental)
    {
        $vehicles = Vehicle::all();
        $customers = Customer::all();
        return view('rentals.edit', compact('rental', 'vehicles', 'customers'));
    }

    public function update(Request $request, Rental $rental)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'customer_id' => 'required|exists:customers,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'status' => 'required|in:active,completed,cancelled'
        ]);

        $rental->update($validated);
        return redirect()->route('rentals.index')->with('success', 'Noleggio aggiornato con successo');
    }

    public function complete(Rental $rental)
    {
        $rental->update(['status' => 'completed']);
        $rental->vehicle->update(['status' => 'available']);
        
        return redirect()->route('rentals.index')->with('success', 'Noleggio completato con successo');
    }

    public function destroy(Rental $rental)
    {
        $rental->delete();
        return redirect()->route('rentals.index')->with('success', 'Noleggio eliminato con successo');
    }
}
