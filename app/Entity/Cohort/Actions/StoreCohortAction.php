<?php

namespace App\Entity\Cohort\Actions;

use App\Entity\Cohort\DTO\CohortDTO;
use App\Entity\Cohort\Models\Cohort;
use App\Entity\Models\CohortUser;

class StoreCohortAction
{
    public function execute(CohortDTO $dto): array
    {

        $schoolId = auth()->user()->current_school_id;

        $cohort = Cohort::create([
            'school_id'=>$schoolId,
            'name' => $dto->name,
            'description' => $dto->description,
            'start_date' => $dto->start_date,
            'end_date' => $dto->end_date,
        ]);

        CohortUser::create([
            'user_id'=> auth()->user()->id,
            'cohort_id' => $cohort->id,
        ]);

        $html = view('pages.cohorts.partials.cohorts-table-row', [
            'cohort' => $cohort,
        ])->render();

        return [
            'html'  => $html,
            'data'  => $cohort,
        ];
    }
}
