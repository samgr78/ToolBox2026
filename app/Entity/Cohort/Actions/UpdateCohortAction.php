<?php

namespace App\Entity\Cohort\Actions;

use App\Entity\Cohort\DTO\CohortDTO;
use App\Entity\Cohort\Models\Cohort;

/**
 * Action responsable de la mise à jour d'une cohort existante.
 */
class UpdateCohortAction
{
    // Met à jour les informations d'une cohort existante.
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
