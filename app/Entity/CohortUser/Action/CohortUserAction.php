<?php

namespace App\Entity\Cohort\Actions;

use App\Entity\Cohort\Models\Cohort;
use App\Entity\CohortUser\DTO\CohortUserDTO;
use App\Entity\User\Models\User;

class AttachUserToCohortAction
{
    public function execute(CohortUserDTO $dto): array
    {
        $cohort = Cohort::findOrFail($dto->cohort_id);
        $user = User::findOrFail($dto->user_id);

        $cohort->users()->syncWithoutDetaching([
            $user->id => ['role' => $dto->role]
        ]);

        $viewName = $dto->role === 'teacher' ? 'pages.cohorts.partials.teacher_row' : 'pages.cohorts.partials.student_row';


        $html = view($viewName, [
            'user' => $user,
            'cohort' => $cohort
        ])->render();

        return [
            'html' => $html,
        ];
    }
}
