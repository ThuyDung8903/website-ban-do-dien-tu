<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $products = Product::all();

            foreach ($products as $product){
                for ($i = 1; $i <= 5; $i++) {
                    $is_thumbnail = $i == 1? 1 : 0;
                    DB::table('images')->insert([
                        'name' => 'image_' . $product->id. $i,
                        'path' => $faker->imageUrl(),
                        'product_id' => $product->id,
                        'is_thumbnail' => $is_thumbnail,
                    ]);
                }
            }
    }
}
