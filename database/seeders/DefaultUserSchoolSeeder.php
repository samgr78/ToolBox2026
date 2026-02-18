<?php

namespace Database\Seeders;

use App\entity\UserSchool;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultUserSchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserSchool::create([
           'user_id'=>1,
           'school_id'=>1,
        ]);
    }
}
