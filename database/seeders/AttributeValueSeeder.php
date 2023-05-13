<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;
use App\Models\AttributeValue;
use Faker\Factory as Faker;

class AttributeValueSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            AttributeValue::create([
                'value' => 'Attribute value '.$i,
                'attribute_id' => $faker->numberBetween(1, 10),
                'status' => $faker->numberBetween(0, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
