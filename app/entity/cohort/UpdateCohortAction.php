<?php

namespace App\entity\cohort;

use App\entity\CohortUser;
use App\entity\UserSchool;

class UpdateCohortAction
{
    public function execute(CohortDTO $dto, Cohort $cohort): Cohort
    {

        $cohort->update([
            'name' => $dto->name,
            'description' => $dto->description,
            'start_date' => $dto->start_date,
            'end_date' => $dto->end_date,
        ]);
        return $cohort;
    }
}
