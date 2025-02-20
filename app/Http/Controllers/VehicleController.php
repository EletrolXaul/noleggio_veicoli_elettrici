<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'model' => 'required|string|max:255',
            'type' => 'required|in:car,scooter,bike',
            'battery_capacity' => 'required|integer',
            'status' => 'required|in:available,rented,maintenance',
            'hourly_rate' => 'required|numeric'
        ]);

        Vehicle::create($validated);
        return redirect()->route('vehicles.index')->with('success', 'Veicolo creato con successo');
    }

    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', compact('vehicle'));
    }

    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'model' => 'required|string|max:255',
            'type' => 'required|in:car,scooter,bike',
            'battery_capacity' => 'required|integer',
            'status' => 'required|in:available,rented,maintenance',
            'hourly_rate' => 'required|numeric'
        ]);

        $vehicle->update($validated);
        return redirect()->route('vehicles.index')->with('success', 'Veicolo aggiornato con successo');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('vehicles.index')->with('success', 'Veicolo eliminato con successo');
    }
}
