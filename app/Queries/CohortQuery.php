<?php

namespace App\Queries;

use App\Entity\Cohort\Cohort;
use Illuminate\Database\Eloquent\Builder;

class CohortQuery
{
    private Builder $query;

    public function __construct(Builder $query, $userId){
        $this->query = $query->Cohort::from('cohorts as C')
            ->join('cohort_users as CU', 'CU.cohort_id', '=', 'C.id')
            ->where('CU.user_id', $userId);
    }

    public static function byUser(String $userId): self
    {
        return new self($userId);
    }
}
