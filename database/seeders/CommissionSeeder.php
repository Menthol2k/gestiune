<?php

namespace Database\Seeders;

use App\Models\Commission;
use App\Models\CommissionItems;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('ro_Ro');

        for ($i = 0; $i < 15; $i++) {
            $commission = Commission::create([
                'client_id' => rand(1, 10),
                'created_by' => 1,
                'number' => $i + 1,
                'year' => '2025',
                'completed' => now()->subDay(rand(1, 20))->format('Y-m-d'),
                'status' => rand(1, 4),
            ]);
            for ($j = 0; $j < rand(2, 6); $j++) {
                CommissionItems::create([
                    'name' => $faker->address(),
                    'commission_id' => $commission->id
                ]);
            }
        }
    }
}
