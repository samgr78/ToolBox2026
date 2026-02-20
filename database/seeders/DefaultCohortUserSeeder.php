<?php

namespace Database\Seeders;

use App\entity\CohortUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultCohortUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cohortUsers=[
            [
                'user_id'=> 2,
                'cohort_id'=> 1,
            ],
            [
                'user_id'=> 3,
                'cohort_id'=> 1,
            ],
            [
                'user_id'=> 1,
                'cohort_id'=> 1,
            ]
        ];
        foreach ($cohortUsers as $cohortUser) {
            CohortUser::create($cohortUser);
        }
    }
}
