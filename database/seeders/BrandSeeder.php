<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
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
            DB::table('brands')->insert([
                'name' => 'Brand ' . $i,
                'image' => $faker->imageUrl(),
                'status' => $faker->randomElement([0, 1]),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
