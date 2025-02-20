<?php

namespace Database\Seeders;

use App\Models\Rental;
use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RentalSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = Vehicle::all();
        $users = User::where('role', 'user')->get();

        foreach($users as $user) {
            // Crea un noleggio attivo per ogni utente
            $vehicle = $vehicles->random();
            $startTime = Carbon::now()->subHours(rand(1, 24));
            $endTime = $startTime->copy()->addHours(rand(1, 12));
            
            Rental::create([
                'vehicle_id' => $vehicle->id,
                'user_id' => $user->id,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'total_cost' => $vehicle->hourly_rate * $startTime->diffInHours($endTime),
                'status' => 'active'
            ]);

            // Crea un noleggio completato per ogni utente
            $vehicle = $vehicles->random();
            $startTime = Carbon::now()->subDays(rand(1, 30));
            $endTime = $startTime->copy()->addHours(rand(1, 12));
            
            Rental::create([
                'vehicle_id' => $vehicle->id,
                'user_id' => $user->id,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'total_cost' => $vehicle->hourly_rate * $startTime->diffInHours($endTime),
                'status' => 'completed'
            ]);
        }
    }
}
