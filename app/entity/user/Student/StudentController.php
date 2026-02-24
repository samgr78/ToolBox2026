<?php

namespace App\entity\user\Student;

use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function index(){
        return view('pages.student.index');
    }
}
