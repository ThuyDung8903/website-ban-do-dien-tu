<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            Customer::create([
                'username' => 'customer'.$i,
                'password' => Hash::make('password'),
                'fullname' => 'Customer '.$i,
                'gender' => $faker->numberBetween(0, 1),
                'email' => 'customer'.$i.'@gmail.com',
                'phone' => $faker->numerify('0#########'),
                'address' => $faker->address,
                'avatar' => $faker->imageUrl(),
                'status' => $faker->numberBetween(0, 1),
            ]);
        }
    }
}
