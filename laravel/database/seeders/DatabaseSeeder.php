<?php

namespace Database\Seeders;

use App\Models\persons;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Create 20 fake records
        for ($i = 0; $i < 87; $i++) {
            persons::create([
                'full_name' => $faker->name,
                'group' => $faker->randomElement(['English', 'It',]),
                'user_id' => $faker->unique()->randomNumber(5, 999),
                'birthday' => $faker->date(),
                'status' => $faker->randomElement(['Called', 'Uncalled']),
                'comment' => '',
                'gender' => $faker->randomElement(['male', 'female']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
