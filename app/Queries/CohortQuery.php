<?php

namespace App\Queries;

use App\Entity\User\Models\User;
use Illuminate\Database\Eloquent\Builder;

class CohortQuery
{
    protected Builder $query;

    public function __construct(string $cohortId)
    {
        $this->query = User::from('users as U')
            ->join('cohort_user as CU', 'CU.user_id', '=', 'U.id')
            ->join('users_schools as US', 'US.user_id', '=', 'U.id')
            ->where('CU.cohort_id', $cohortId)
            ->select('U.*', 'US.role as pivot_role');
    }

    public static function forCohort(string $cohortId): self
    {
        return new self($cohortId);
    }

    public function forSchool(string $schoolId): self
    {
        $this->query->where('US.school_id', $schoolId);

        return $this;
    }

    public function forRole(string $role): self
    {
        $this->query->where('US.role', $role);

        return $this;
    }

    public function excludeIds(array $ids): self
    {
        if (!empty($ids)) {
            $this->query->whereNotIn('U.id', $ids);
        }

        return $this;
    }

    public function get()
    {
        return $this->query->get();
    }

    public function pluckIds(): array
    {
        return $this->query->pluck('U.id')->toArray();
    }
}
