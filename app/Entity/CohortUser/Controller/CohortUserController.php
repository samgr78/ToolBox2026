<?php

namespace App\Entity\CohortUser\Controller;

use App\Entity\Cohort\Models\Cohort;
use App\Entity\CohortUser\Request;
use App\Http\Controllers\Controller;

class CohortUserController extends Controller
{
    /**
     * Attache un utilisateur (étudiant ou enseignant) à une promotion.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cohort_id' => 'required|exists:cohorts,id',
            'user_id'   => 'required|exists:users,id',
            'role'      => 'required|in:student,teacher',
        ]);

        $cohort = Cohort::findOrFail($validated['cohort_id']);

        $cohort->users()->syncWithoutDetaching([
            $validated['user_id'] => ['role' => $validated['role']]
        ]);

        return response()->json([
            'success' => true,
            'message' => $validated['role'] === 'student'
                ? 'Étudiant ajouté avec succès !'
                : 'Enseignant ajouté avec succès !'
        ]);
    }
}
