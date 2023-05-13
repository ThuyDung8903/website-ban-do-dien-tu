<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as FakerFactory;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sử dụng thư viện Faker để tạo dữ liệu giả
        $faker = FakerFactory::create();

        // Tạo 20 đơn hàng mẫu
        for ($i = 0; $i < 10; $i++) {
            DB::table('orders')->insert([
                'customer_id' => $faker->numberBetween(1, 10),
                'shipping_method_id' => $faker->numberBetween(1, 5),
                'payment_method_id' => $faker->numberBetween(1, 5),
                'total_price' => $faker->numberBetween(1000, 10000),
                'total_bill' => $faker->numberBetween(1000, 100000),
                'order_status_id' => $faker->numberBetween(1, 8),
                'comment' => $faker->text(),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now')
            ]);
        }
    }
}
