<?php

namespace Database\Seeders;

use App\Models\Rental;
use App\Models\Vehicle;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class RentalSeeder extends Seeder
{
    public function run(): void
    {
        $vehicle = Vehicle::first();
        $customer = Customer::first();

        Rental::create([
            'vehicle_id' => $vehicle->id,
            'customer_id' => $customer->id,
            'start_time' => now(),
            'end_time' => now()->addHours(2),
            'total_cost' => $vehicle->hourly_rate * 2,
            'status' => 'active'
        ]);
    }
}
