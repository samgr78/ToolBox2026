<?php

namespace App\Queries;

use App\Entity\User\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserQuery
{
    protected Builder $query;

    public function __construct(string $currentSchoolId) {
        $this->query = User::from('users as U')
                        ->join('users_schools as US', 'US.user_id', '=', 'U.id')
                        ->where('US.school_id', $currentSchoolId)
                        ->select('U.*');
    }

    public static function forSchool(string $currentSchoolId): self
    {
        return new self($currentSchoolId);
    }

    public function forRole(string $role): self
    {
        $this->query->where('role', $role);

        return $this;
    }

    public function get() {
        return $this->query->get();
    }

    public function userHasRole(User $user, string $role): bool
    {
        return $this->query
            ->where('U.id', $user->id)
            ->where('US.role', $role)
            ->exists();
    }
}
