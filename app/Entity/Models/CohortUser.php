<?php

namespace App\Entity\Models;

use App\Entity\Cohort\Models\Cohort;
use App\Entity\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle représentant la table pivot cohort_user.
 */
class CohortUser extends Model
{
    protected $table = 'cohort_user';

    protected $fillable = ['user_id', 'cohort_id'];

    /**
     * Utilisateur rattaché à cette entrée de la table pivot.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Cohort rattachée à cette entrée de la table pivot.
     */
    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }

}
