<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderStatus;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            'Pending',
            'Processing',
            'Shipped',
            'Delivered',
            'Cancelled',
            'Refunded',
            'Returned',
            'Completed',
        ];

        foreach ($statuses as $status) {
            OrderStatus::create([
                'name' => $status,
            ]);
        }
    }
}

