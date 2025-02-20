<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Customer;
use App\Models\Rental;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistiche base
        $stats = [
            'total_vehicles' => Vehicle::count(),
            'available_vehicles' => Vehicle::where('status', 'available')->count(),
            'active_rentals' => Rental::where('status', 'active')->count(),
            'total_customers' => Customer::count(),
            'monthly_revenue' => Rental::where('status', 'completed')
                ->whereMonth('created_at', now()->month)
                ->sum('total_cost'),
        ];
        
        // Recupera i veicoli più noleggiati
        $popularVehicles = Vehicle::withCount(['rentals' => function($query) {
            $query->where('status', 'completed');
        }])
        ->orderBy('rentals_count', 'desc')
        ->take(5)
        ->get();

        return view('dashboard', compact('stats', 'popularVehicles'));
    }
}