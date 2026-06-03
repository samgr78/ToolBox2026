<?php

namespace App\Policies;

use App\Entity\Cohort\Models\Cohort;
use App\Entity\User\Models\User;

class CohortPolicy
{
    /**
     * Déterminer si l'utilisateur peut afficher des modèles.
     */
    public function viewAny(User $user): bool
    {
        return $user->schools()->wherePivotIn('role', ['admin', 'teacher'])->exists();
    }

    /**
     * Déterminer si l'utilisateur peut afficher le modèle.
     */
    public function view(User $user, Cohort $cohort): bool
    {
        return in_array($user->roleInSchool($cohort->school_id), ['admin', 'teacher']);
    }


    /**
     * Déterminer si l'utilisateur peut créer des modèles.
     */
    public function create(User $user): bool
    {
        return $user->schools()->wherePivot('role', 'admin')->exists();
    }


    /**
     * Déterminez si l'utilisateur peut mettre à jour le modèle.
     */
    public function update(User $user, Cohort $cohort): bool
    {
        return $user->hasRoleInSchool('admin', $cohort->school_id);
    }

    /**
     * Déterminez si l'utilisateur peut supprimer le modèle.
     */
    public function delete(User $user, Cohort $cohort): bool
    {
        return $user->hasRoleInSchool('admin', $cohort->school_id);
    }

    /**
     * Déterminez si l'utilisateur peut restaurer le modèle.
     */
    public function restore(User $user, Cohort $cohort): bool
    {
        return false;
    }

    /**
     * Déterminez si l'utilisateur peut supprimer définitivement le modèle.
     */
    public function forceDelete(User $user, Cohort $cohort): bool
    {
        return false;
    }
}
