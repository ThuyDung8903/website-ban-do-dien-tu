<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 20; $i++) {
            DB::table('categories')->insert([
                'name' => 'Category ' . $i,
                'parent_id' => $faker->randomFloat(null, 1, 10),
                'status' => $faker->randomElement([0, 1]),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
