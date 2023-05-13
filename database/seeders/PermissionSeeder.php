<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $users = User::all();

        foreach ($users as $user) {
            DB::table('permissions')->insert([
                'permission' => $faker->randomElement(['create', 'read', 'edit', 'delete', 'crud', 'admin']),
                'user_id' => $user->id,
                'start_time' => now(),
                'end_time' => now()->addYear(),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
