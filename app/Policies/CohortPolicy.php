<?php

namespace App\Policies;

use App\entity\cohort\Cohort;
use App\entity\user\User;
use Illuminate\Auth\Access\Response;

class CohortPolicy
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
     * Determine whether the user can update the model.
     */
    public function update(User $user, Cohort $cohort): bool
    {
        return $user->hasRoleInSchool('admin', $cohort->school_id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Cohort $cohort): bool
    {
        return $user->hasRoleInSchool('admin', $cohort->school_id);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Cohort $cohort): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Cohort $cohort): bool
    {
        return false;
    }
}
