<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UpdateProductsSeeder extends Seeder
{
    public function run()
    {
        $products = Product::all();
        $faker = Factory::create();
        foreach ($products as $product) {
            if ($product->slug == null) {
                $product->update([
                    'slug' => Str::slug($product->name),
                    'quantity' => rand(0, 1000),
                    'trending' => rand(0, 1),
                    'meta_title' => Str::title($product->name),
                    'meta_keyword' => Str::slug($faker->sentence(5), ','),
                    'meta_description' => $faker->sentence(20),
                ]);
            }
        }
    }
}
