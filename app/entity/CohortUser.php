<?php

namespace App\entity;

use App\entity\cohort\Cohort;
use Illuminate\Database\Eloquent\Model;

class CohortUser extends Model
{
    protected $table = 'cohort_user';

    protected $fillable = ['user_id', 'cohort_id'];

    /**
     * Get the user who created or owns this resource.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the cohort associated with this resource.
     */
    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }

}
