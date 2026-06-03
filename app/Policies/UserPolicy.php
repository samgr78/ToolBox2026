<?php

namespace App\Policies;

use App\Entity\Cohort\Models\Cohort;
use App\Entity\User\Models\User;

class UserPolicy
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
    public function view(User $user, User $model): bool
    {
        return $user->id === $model->id || $user->schools()
            ->wherePivotIn('role', ['admin', 'teacher'])
            ->exists();
    }


    /**
     * Déterminer si l'utilisateur peut créer des modèles.
     */
    public function create(User $user): bool
    {
        return $user->schools()->wherePivot('role', 'admin')->exists();
    }

    /**
     * Déterminer si l'utilisateur peut mettre à jour le modèle.
     */
    public function update(User $user, User $model): bool
    {
        return $user->schools()->wherePivot('role', 'admin')->exists();
    }

    /**
     * Déterminez si l'utilisateur peut supprimer le modèle.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->schools()->wherePivot('role', 'admin')->exists();
    }
}
