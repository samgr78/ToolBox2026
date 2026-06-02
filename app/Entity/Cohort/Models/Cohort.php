<?php

namespace App\Entity\Cohort\Models;

use App\Entity\Cohort\Assessment;
use App\Entity\Cohort\Task;
use App\Entity\School\Models\School;
use App\Entity\User\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle représentant une cohort
 */
class Cohort extends Model
{
    protected $table        = 'cohorts';
    protected $fillable     = ['school_id', 'name', 'description', 'start_date', 'end_date'];

    /**
     * Évaluations rattachées à la cohort.
     */
    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    /**
     * Tous les utilisateurs de la cohorte (étudiants, enseignants…) via la table pivot cohort_user.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'cohort_user');
    }

    /**
     * Tâches rattachées à la cohort via la table pivot cohort_task.
     */
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'cohort_task')->withTimestamps();
    }

    public function cohorts()
    {
        return $this->hasMany(Cohort::class);
    }

    /**
     * Établissement auquel appartient la cohort.
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    /**
     * Étudiants appartenant à cette cohort (filtrés par rôle).
     */
    public function students()
    {
        return $this->users->filter(function($user) {
            return $user->roleInSchool($this->school_id) === 'student';
        });
    }

    /**
     * Enseignants appartenant à cette cohort (filtrés par rôle).
     */
    public function teachers()
    {
        return $this->users->filter(function($user) {
            return $user->roleInSchool($this->school_id) === 'teacher';
        });
    }

}
