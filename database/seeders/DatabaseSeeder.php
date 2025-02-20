<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crea un utente admin
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        // Utenti normali
        User::factory(5)->create([
            'role' => 'user'
        ]);

        // L'ordine è importante per le dipendenze
        $this->call([
            VehicleSeeder::class,
            RentalSeeder::class
        ]);
    }
}
