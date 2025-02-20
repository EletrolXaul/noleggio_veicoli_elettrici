<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;

class HomeController extends Controller
{
    public function index()
    {
        $availableVehicles = Vehicle::where('status', 'available')
            ->orderBy('model')
            ->take(6)
            ->get();

        return view('home', compact('availableVehicles'));
    }
}