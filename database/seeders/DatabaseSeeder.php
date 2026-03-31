<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            DefaultUserSeeder::class,
        ]);
        $this->call([
            DefaultSchoolSeeder::class,
        ]);
        $this->call([
            DefaultUserSchoolSeeder::class,
        ]);
        $this->call([
            DefaultCohortSeeder::class,
        ]);
        $this->call([
            DefaultCohortUserSeeder::class,
        ]);
    }
}
