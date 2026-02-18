<?php

namespace App\entity\cohort;

use App\entity\UserSchool;

class StoreCohortAction
{
    public function execute(CohortDTO $dto): Cohort
    {

        $school = auth()->user()->schools()->first();

        $cohort = Cohort::create([
            'school_id'=>$school->id,
            'name' => $dto->name,
            'description' => $dto->description,
            'start_date' => $dto->start_date,
            'end_date' => $dto->end_date,
        ]);
        return $cohort;
    }
}
