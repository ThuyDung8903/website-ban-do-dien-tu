<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;
use Faker\Factory as Faker;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Generate 5 sample payment methods
        for ($i = 1; $i <= 5; $i++) {
            PaymentMethod::create([
                'name' => 'Payment Method ' . $i,
                'status' => 1,
            ]);
        }
    }
}
