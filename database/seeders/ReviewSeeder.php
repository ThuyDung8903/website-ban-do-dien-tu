<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\Product;
use App\Models\Customer;
use Faker\Factory as Faker;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $products = Product::all();
        $customers = Customer::all();

        foreach ($products as $product) {
            for ($i = 0; $i < 5; $i++) {
                $customer = $customers->random();
                $rating = $faker->numberBetween(1, 5);
                Review::create([
                    'content' => $faker->paragraph,
                    'rating' => $rating,
                    'product_id' => $product->id,
                    'customer_id' => $customer->id,
                    'status' => $faker->numberBetween(0, 1),
                    'created_at' => $faker->dateTimeBetween($product->created_at, 'now'),
                    'updated_at' => $faker->dateTimeBetween($product->created_at, 'now'),
                ]);

                $reviews = $product->reviews();
                if ($reviews) {
                    $product->update(['rating' => $reviews->avg('rating')]);
                }
            }
        }
    }
}
