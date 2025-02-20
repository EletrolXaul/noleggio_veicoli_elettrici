<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;

class AdminVehicleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $vehicles = Vehicle::with(['rentals' => function($query) {
            $query->latest();
        }])
        ->withCount(['rentals as active_rentals_count' => function($query) {
            $query->where('status', 'active');
        }])
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        
        return view('admin.vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('admin.vehicles.create');
    }

    public function store(StoreVehicleRequest $request)
    {
        $vehicle = Vehicle::create($request->validated());

        return redirect()->route('admin.vehicles.index')
                        ->with('success', 'Veicolo aggiunto con successo');
    }

    public function show(Vehicle $vehicle)
    {
        $vehicle->load(['rentals.user']);
        return view('admin.vehicles.show', compact('vehicle'));
    }

    public function edit(Vehicle $vehicle)
    {
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        $vehicle->update($request->validated());

        return redirect()->route('admin.vehicles.index')
                        ->with('success', 'Veicolo aggiornato con successo');
    }

    public function destroy(Vehicle $vehicle)
    {
        if ($vehicle->rentals()->where('status', 'active')->exists()) {
            return back()->with('error', 'Non puoi eliminare un veicolo con noleggi attivi');
        }

        $vehicle->delete();

        return redirect()->route('admin.vehicles.index')
                        ->with('success', 'Veicolo eliminato con successo');
    }

    public function toggleStatus(Vehicle $vehicle)
    {
        if ($vehicle->status === 'available') {
            $vehicle->update(['status' => 'maintenance']);
        } else {
            $vehicle->update(['status' => 'available']);
        }

        return back()->with('success', 'Stato del veicolo aggiornato');
    }
}
