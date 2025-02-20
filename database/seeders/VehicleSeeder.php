<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        Vehicle::create([
            'model' => 'Tesla Model 3',
            'type' => 'car',
            'battery_capacity' => 100,
            'status' => 'available',
            'hourly_rate' => 25.00
        ]);

        Vehicle::create([
            'model' => 'NIU KQi3',
            'type' => 'scooter',
            'battery_capacity' => 80,
            'status' => 'available',
            'hourly_rate' => 10.00
        ]);
    }
}
