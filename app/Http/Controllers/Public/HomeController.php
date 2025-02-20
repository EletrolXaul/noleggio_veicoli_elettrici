<?php

namespace App\Http\Controllers\Public;  // Modifica il namespace

use App\Http\Controllers\Controller;
use App\Models\Vehicle;

class HomeController extends Controller
{
    public function index()
    {
        $availableVehicles = Vehicle::where('status', 'available')
            ->orderBy('model')
            ->take(6)
            ->get();

        return view('public.home', compact('availableVehicles')); // Modifica qui
    }
}