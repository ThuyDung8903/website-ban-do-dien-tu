<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 20; $i++) {
            DB::table('images')->insert([
                'name' => 'image' . $i,
                'path' => $faker->imageUrl(),
                'product_id' => $faker->numberBetween(1, 50),
                'is_thumbnail' => $faker->numberBetween(0, 1),
            ]);
        }
    }
}
