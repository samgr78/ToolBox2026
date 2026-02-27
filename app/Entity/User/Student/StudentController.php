<?php

namespace App\Entity\User\Student;

use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function index(){
        return view('pages.students.index');
    }
}
