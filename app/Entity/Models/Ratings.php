<?php

namespace App\Entity\Models;
use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    protected $table = 'ratings';
    protected $fillable = ['rate', 'tests'];
}
