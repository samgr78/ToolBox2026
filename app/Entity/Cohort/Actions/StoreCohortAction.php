<?php

namespace App\Entity\Cohort\Actions;

use App\Entity\Cohort\DTO\CohortDTO;
use App\Entity\Cohort\Models\Cohort;
use App\Entity\Models\CohortUser;

/**
 * Action responsable de la création d'une nouvelle cohorte.
 */
class StoreCohortAction
{
    /**
     * Crée une cohort et associe l'utilisateur actuel à cette cohort.
     * @param CohortDTO $dto  Données validées de la cohorte à créer
     */
    public function execute(CohortDTO $dto): array
    {

        $schoolId = auth()->user()->current_school_id;

        // Créer la cohort
        $cohort = Cohort::create([
            'school_id'=>$schoolId,
            'name' => $dto->name,
            'description' => $dto->description,
            'start_date' => $dto->start_date,
            'end_date' => $dto->end_date,
        ]);

        // Associer l'utilisateur actuel à la cohorte créée
        CohortUser::create([
            'user_id'=> auth()->user()->id,
            'cohort_id' => $cohort->id,
        ]);

        // Rendu du partial HTML pour injection Ajax côté client
        $html = view('pages.cohorts.partials.cohorts-table-row', [
            'cohort' => $cohort,
        ])->render();

        return [
            'html'  => $html,
            'data'  => $cohort,
        ];
    }
}
