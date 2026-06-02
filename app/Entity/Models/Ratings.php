<?php

namespace App\Entity\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle représentant une note attribuée à un utilisateur.
 */
class Ratings extends Model
{
    protected $table = 'ratings';
    protected $fillable = ['rate', 'tests'];
}
