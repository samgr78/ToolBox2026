<?php

namespace App\Entity\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modèle représentant la relation pivot entre un utilisateur et un établissement.
 */
class UserSchool extends Model
{
    protected $table        = 'users_schools';
    protected $fillable     = ['user_id', 'school_id', 'role', 'active'];
}
