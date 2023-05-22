<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $price = $faker->numberBetween(100, 10000);

        for ($i = 1; $i <= 100; $i++) {
            DB::table('products')->insert([
                'name' => 'Product ' . $i,
                'price' => $price,
                'sale_price' => $faker->numberBetween(0, $price),
                'category_id' => $faker->numberBetween(1, 20),
                'brand_id' => $faker->numberBetween(1, 10),
                'short_description' => $faker->paragraph,
                'detail_description' => $faker->text(500),
                'slug' => 'default',
                'quantity' => rand(0, 1000),
                'trending' => rand(0, 1),
                'meta_title' => 'default',
                'meta_keyword' => 'default',
                'meta_description' => 'default',
                'view' => $faker->numberBetween(100, 1000),
                'total_sold' => $faker->numberBetween(1, 1000),
                'status' => $faker->randomElement([0, 1]),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}