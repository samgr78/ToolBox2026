<?php

namespace App\Entity\School\Models;

use Database\Factories\Entity\School\SchoolFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle représentant un établissement scolaire.
 */
class School extends Model
{

    use HasFactory;

    protected static function newFactory(): SchoolFactory
    {
        return SchoolFactory::new();
    }

    protected $table        = 'schools';
    protected $fillable     = ['user_id', 'name', 'description'];
}
