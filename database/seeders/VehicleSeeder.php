<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = [
            [
                'model' => 'Tesla Model 3',
                'type' => 'car',
                'battery_capacity' => 100,
                'status' => 'available',
                'hourly_rate' => 25.00
            ],
            [
                'model' => 'Tesla Model Y',
                'type' => 'car',
                'battery_capacity' => 95,
                'status' => 'available',
                'hourly_rate' => 30.00
            ],
            [
                'model' => 'NIU KQi3',
                'type' => 'scooter',
                'battery_capacity' => 80,
                'status' => 'available',
                'hourly_rate' => 10.00
            ],
            [
                'model' => 'VanMoof S3',
                'type' => 'bike',
                'battery_capacity' => 75,
                'status' => 'available',
                'hourly_rate' => 5.00
            ]
        ];

        foreach ($vehicles as $vehicle) {
            Vehicle::create($vehicle);
        }
    }
}
