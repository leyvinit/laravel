<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 10 users under 15
        User::factory()
            ->count(10)
            ->state(fn () => ['age' => fake()->numberBetween(10, 14)])
            ->create();

        // 15 users above 15
        User::factory()
            ->count(15)
            ->state(fn () => ['age' => fake()->numberBetween(16, 40)])
            ->create();
    }
}
