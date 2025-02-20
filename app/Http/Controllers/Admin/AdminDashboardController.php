<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\Rental;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_vehicles' => Vehicle::count(),
            'available_vehicles' => Vehicle::where('status', 'available')->count(),
            'active_rentals' => Rental::where('status', 'active')->count(),
            'total_users' => User::where('role', 'user')->count(),
        ];

        $popularVehicles = Vehicle::withCount(['rentals' => function($query) {
            $query->where('status', 'completed');
        }])
        ->orderBy('rentals_count', 'desc')
        ->take(5)
        ->get();

        return view('admin.dashboard', compact('stats', 'popularVehicles'));
    }
}
