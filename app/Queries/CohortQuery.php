<?php

namespace App\Queries;

use App\Entity\Cohort\Models\Cohort;
use Illuminate\Database\Eloquent\Builder;

class CohortQuery
{
    protected Builder $query;

    public function __construct(int $schoolId) {
        $this->query = Cohort::where('school_id', $schoolId);
    }

    public static function forSchool(int $schoolId): self
    {
        return new self($schoolId);
    }

    public function get() {
        return $this->query->get();
    }
}
