<?php

namespace Database\Seeders;

use App\Entity\School\School;
use App\Entity\User\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
