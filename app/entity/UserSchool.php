<?php

namespace App\entity;

use Illuminate\Database\Eloquent\Model;

class UserSchool extends Model
{
    protected $table        = 'users_schools';
    protected $fillable     = ['user_id', 'school_id', 'role', 'active'];
}
