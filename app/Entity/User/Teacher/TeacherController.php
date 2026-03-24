<?php

namespace App\Entity\User\Teacher;

use App\Http\Controllers\Controller;
use App\Queries\UserQuery;

class TeacherController extends Controller
{
    public function index(){
        $users = UserQuery::forSchool(auth()->user()->current_school_id)->forRole('teacher')->get();
        return view('pages.teachers.index', compact('users'));
    }
}
