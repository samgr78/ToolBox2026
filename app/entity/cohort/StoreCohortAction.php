<?php

namespace App\entity\cohort;

class StoreCohortAction
{
    public function execute(CohortDTO $dto): Cohort
    {
        $cohort = Cohort::create([
            'name' => $dto->name,
            'description' => $dto->description,
            'start_date' => $dto->start_date,
            'end_date' => $dto->end_date,
        ]);
        return $cohort;
    }
}
