<?php

namespace Database\Seeders;

use App\entity\cohort\Cohort;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultCohortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cohorts=[
            [
                'school_id'=>1,
                'name'=>'cohort1',
                'description'=>'cohort1',
                'start_date'=>'2021-10-10',
                'end_date'=>'2021-11-10',
            ],
            [
                'school_id'=>1,
                'name'=>'cohort2',
                'description'=>'cohort2',
                'start_date'=>'2021-10-10',
                'end_date'=>'2021-11-10',
            ]
        ];
        foreach ($cohorts as $cohort) {
            Cohort::create($cohort);
        }
    }
}
