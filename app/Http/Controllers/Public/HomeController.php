<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Utente non autenticato - mostra solo veicoli disponibili senza possibilità di prenotazione
        if (!Auth::check()) {
            $availableVehicles = Vehicle::where('status', 'available')
                ->orderBy('model')
                ->take(6)
                ->get();
                
            return view('public.home', [
                'availableVehicles' => $availableVehicles,
                'showBookingButtons' => false
            ]);
        }

        // Admin - reindirizza alla dashboard admin
        /** @var User $user */
        $user = Auth::user();
        if ($user && $user->role === User::ROLE_ADMIN) {
            return redirect()->route('admin.dashboard');
        }

        // Utente normale - mostra dashboard con funzionalità complete
        return redirect()->route('user.dashboard');
    }
}