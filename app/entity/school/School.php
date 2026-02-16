<?php

namespace App\entity\school;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table        = 'schools';
    protected $fillable     = ['user_id', 'name', 'description'];
}
