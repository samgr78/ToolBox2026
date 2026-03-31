<?php

namespace App\Entity\CohortUser\Actions;

use App\Entity\Cohort\Models\Cohort;
use App\Entity\User\Models\User;

class CohortUserAction
{
    public function execute(array $data): array
    {
        $cohort = Cohort::findOrFail($data['cohort_id']);
        $user = User::findOrFail($data['user_id']);

        $cohort->users()->syncWithoutDetaching([$user->id]);

        $viewName = $data['role'] === 'teacher' ? 'pages.cohorts.partials.teachers-table-row' : 'pages.cohorts.partials.students-table-row';

        $html = view($viewName, [
            'user' => $user,
            'cohort' => $cohort
        ])->render();

        return [
            'html' => $html,
        ];
    }
}
