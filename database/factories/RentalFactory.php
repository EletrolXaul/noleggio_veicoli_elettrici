<?php

namespace Database\Factories;

use App\Models\Rental;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class RentalFactory extends Factory
{
    protected $model = Rental::class;

    public function definition(): array
    {
        $startTime = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $endTime = clone $startTime;
        $endTime->modify('+' . rand(1, 24) . ' hours');
        
        $vehicle = Vehicle::factory()->create();
        $hours = $startTime->diff($endTime)->h;

        return [
            'vehicle_id' => $vehicle->id,
            'user_id' => User::factory()->create(['role' => 'user'])->id,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'total_cost' => $vehicle->hourly_rate * $hours,
            'status' => $this->faker->randomElement(['active', 'completed', 'cancelled'])
        ];
    }

    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'active'
            ];
        });
    }
}