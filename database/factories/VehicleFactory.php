<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    public function definition(): array
    {
        return [
            'model' => $this->faker->randomElement(['Tesla Model 3', 'NIU KQi3', 'VanMoof S3']),
            'type' => $this->faker->randomElement(['car', 'scooter', 'bike']),
            'battery_capacity' => $this->faker->numberBetween(0, 100),
            'status' => 'available',
            'hourly_rate' => $this->faker->randomFloat(2, 10, 50)
        ];
    }
}