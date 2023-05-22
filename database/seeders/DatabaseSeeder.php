<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            BannerSeeder::class,
            ImageSeeder::class,
            CustomerSeeder::class,
            AttributeSeeder::class,
            AttributeValueSeeder::class,
            ProductAttributeValueSeeder::class,
            ReviewSeeder::class,
            PermissionSeeder::class,
            ShippingMethodSeeder::class,
            PaymentMethodSeeder::class,
            OrderStatusSeeder::class,
            OrderSeeder::class,
            OrderDetailSeeder::class,
            UpdateProductsSeeder::class,
            UpdateCategorySeeder::class,
        ]);
    }
}