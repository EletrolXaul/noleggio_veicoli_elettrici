<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'name' => 'Mario Rossi',
            'email' => 'mario.rossi@example.com',
            'phone' => '3331234567',
            'license_number' => 'AB123CD'
        ]);

        Customer::create([
            'name' => 'Luigi Verdi',
            'email' => 'luigi.verdi@example.com',
            'phone' => '3339876543',
            'license_number' => 'XY789WZ'
        ]);
    }
}
