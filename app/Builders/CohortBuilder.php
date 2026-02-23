<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class CohortBuilder extends Builder
{
    public function forSchool(int $schoolId)
    {
        return $this->where('school_id', $schoolId);
    }
}
