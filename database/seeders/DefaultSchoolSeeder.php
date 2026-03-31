<?php

namespace Database\Seeders;

use App\Entity\School\Models\School;
use Illuminate\Database\Seeder;

class DefaultSchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        School::firstOrCreate(
            [
                'user_id' => 1,
                'name'  => 'ecoleSeeder1',
                'description' => 'cest le seeder 1',
            ]
        );
    }
}
