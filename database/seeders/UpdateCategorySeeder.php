<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UpdateCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $categories = Category::all();
        foreach ($categories as $category){
            $category->description = $faker->sentence(8);
            $category->update([
                'slug' => Str::slug($category->name),
                'description' => $category->description,
                'meta_title' => Str::title($category->name),
                'meta_keywords' => Str::slug($faker->sentence(5), ', '),
                'meta_description' => Str::slug($category->description, ', ')
            ]);
        }
    }
}