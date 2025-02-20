<?php
// app/Http/Controllers/Public/VehicleController.php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $query = Vehicle::query();

        // Filtro per tipo
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        // Filtro per prezzo massimo
        if ($request->has('max_price')) {
            $query->where('hourly_rate', '<=', $request->max_price);
        }

        $vehicles = $query->paginate(12);
        
        return view('public.vehicles.index', compact('vehicles'));
    }

    public function show(Vehicle $vehicle)
    {
        return view('public.vehicles.show', compact('vehicle'));
    }
}