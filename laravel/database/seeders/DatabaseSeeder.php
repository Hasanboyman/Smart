<?php

namespace Database\Seeders;

use App\Models\persons;
use App\Models\reports;
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

        // Create 87 fake records in the persons table
        for ($i = 0; $i < 87; $i++) {
            $person = persons::create([
                'full_name' => $faker->name,
                'group' => $faker->randomElement(['English', 'It']),
                'user_id' => $faker->unique()->randomNumber(5), // Generates a unique 5-digit number
                'birthday' => $faker->date(),
                'status' => $faker->randomElement(['Called', 'Uncalled']),
                'comment' => $faker->text,
                'gender' => $faker->randomElement(['male', 'female']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            reports::create([
                'title' => $faker->sentence,
                'message' => $faker->paragraph,
                'feedback' => $faker->paragraph,
                'rating' => $faker->numberBetween(1, 5),
                'status' => $faker->randomElement(['pending',  'solved']),
                'person_id' => $person->id,
                'user_id' => $person->user_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
