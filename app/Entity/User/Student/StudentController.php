<?php

namespace App\Entity\User\Student;

use App\Entity\Cohort\Models\Cohort;
use App\Http\Controllers\Controller;
use App\Queries\UserQuery;

class StudentController extends Controller
{
    public function index(){
        $users = UserQuery::forSchool(auth()->user()->current_school_id)->forRole('student')->get();
        return view('pages.students.index', compact('users'));
    }

    public function addIntoCohort(Cohort $cohort){

    }
}
