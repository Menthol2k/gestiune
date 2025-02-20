<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('ro_Ro');

        for ($i = 0; $i <= 25; $i++) {
            $j = "J" . rand(1998, 2024) . $faker->bothify('#########');

            Client::create([
                'name' => $faker->company(),
                'cui' => $faker->bothify('RO########'),
                'contact_person' => $faker->lastName() . ' ' . $faker->firstName(),
                'email' => $faker->safeEmail(),
                'phone' => $faker->bothify('07########'),
                'reg_com' => $j,
                'office_address' => $faker->address(),
                'capital_social' => $faker->bothify('#####'),
                'euid' => 'ROONRC.' . $j,
                'bank' => $faker->randomElement(['Banca Transilvania', 'BCR', 'BRD', 'Raiffeisen Bank', 'ING Bank']),
                'iban' => $faker->iban('ro'),
                'created_by' => 1,
            ]);
        }
    }
}
