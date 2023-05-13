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
        $attributes = Attribute::all();

        foreach ($attributes as $attribute) {
            for ($i = 1; $i <= 3; $i++) {
                AttributeValue::create([
                    'value' => 'Attribute value ' . $i . ' - attribute ' . $attribute->id,
                    'attribute_id' => $attribute->id,
                    'status' => $faker->numberBetween(0, 1),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

    }
}
