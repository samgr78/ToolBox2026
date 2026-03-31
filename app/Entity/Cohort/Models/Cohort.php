<?php

namespace App\Entity\Cohort\Models;

use App\Builders\CohortBuilder;
use App\Entity\Cohort\Assessment;
use App\Entity\Cohort\Task;
use App\Entity\School\Models\School;
use App\Entity\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class Cohort extends Model
{
    protected $table        = 'cohorts';
    protected $fillable     = ['school_id', 'name', 'description', 'start_date', 'end_date'];

    public function newEloquentBuilder($query)
    {
        return new CohortBuilder($query);
    }

    /**
     * Get all assessments associated with this cohort.
     */
    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    /**
     * Get all users (students, etc.) belonging to this cohort.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'cohort_user');
    }

    /**
     * Get all tasks linked to this cohort.
     */
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'cohort_task')->withTimestamps();
    }

    public function cohorts()
    {
        return $this->hasMany(Cohort::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }


}
