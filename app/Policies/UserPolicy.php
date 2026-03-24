<?php

namespace App\Policies;

use App\Entity\Cohort\Models\Cohort;
use App\Entity\User\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->schools()->wherePivotIn('role', ['admin', 'teacher'])->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Cohort $cohort): bool
    {
        return in_array($user->roleInSchool($cohort->school_id), ['admin', 'teacher']);
    }


    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->schools()->wherePivot('role', 'admin')->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->schools()->wherePivot('role', 'admin')->exists();
    }
}
