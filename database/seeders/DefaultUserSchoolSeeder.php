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
        $userSchools= [
            [
                'user_id' => 1,
                'school_id' => 1,
                'role'=>'admin',
            ],
            [
                'user_id' => 2,
                'school_id' => 1,
                'role'=>'teacher',
            ],
            [
                'user_id' => 3,
                'school_id' => 1,
                'role'=>'student',
            ],
        ];
        foreach ($userSchools as $userSchool) {
            UserSchool::create($userSchool);
        }
    }
}
