<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            ['name' => 'Octavian Gabriel', 'email' => 'octavian@lodgrin.com', 'password' => env('FIRST_USER_PASS'), 'role_id' => 1],
        ])->each(function ($factory) {
            $user = User::factory()->make([
                'name' => $factory['name'],
                'email' => $factory['email'],
            ]);

            $user->password = Hash::make($factory['password']);

            $user->save();

            $user->assignRole(Role::find($factory['role_id']));

        });
    }
}
