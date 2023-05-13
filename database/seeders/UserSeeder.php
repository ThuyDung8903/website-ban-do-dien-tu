<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i = 1; $i <= 10; $i++) {
            DB::table('users')->insert([
                'username' => 'username' . $i,
                'password' => Hash::make('password'),
                'fullname' => 'User ' . $i,
                'email' => 'user' . $i . '@gmail.com',
                'phone' => $faker->numerify('0#########'),
                'address' => $faker->address,
                'avatar' => $faker->imageUrl(),
                'role' => $faker->randomElement(['shop-assistant', 'accountant', 'manager', 'shopkeeper']),
                'status' => $faker->randomElement([0, 1]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
