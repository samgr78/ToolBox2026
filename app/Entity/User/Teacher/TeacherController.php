<?php

namespace App\Entity\User\Teacher;

use App\Entity\Cohort\Models\Cohort;
use App\Http\Controllers\Controller;
use App\Queries\UserQuery;

class CohortUserController extends Controller
{
    /**
     * Attache un étudiant ou un enseignant à la promotion.
     */
    public function store(AttachUserRequest $request, AttachUserToCohortAction $action)
    {
        //$this->authorize('store', Cohort::class);
        $dto = CohortUserDTO::fromRequest($request);
        $result = $action->execute($dto);

        return response()->json([
            'success' => true,
            'html'    => $result['html'],
        ]);
    }

    /**
     * Détache un utilisateur de la promotion (pour le bouton supprimer de ta ligne)
     */
    public function destroy(Cohort $cohort, $userId)
    {
        // $this->authorize('delete', $cohort);
        $cohort->users()->detach($userId);

        return response()->json([
            'success' => true,
        ]);
    }
}
