<?php

namespace App\Entity\Cohort;

use App\Entity\CohortUser;
use App\Entity\UserSchool;

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
