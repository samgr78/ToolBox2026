<?php

namespace App\Entity\Cohort\Actions;

use App\Entity\Cohort\DTO\CohortDTO;
use App\Entity\Cohort\Models\Cohort;

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
