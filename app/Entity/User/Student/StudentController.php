<?php

namespace App\Entity\User\Student;

use App\Http\Controllers\Controller;
use App\Entity\User\User;

class StudentController extends Controller
{
    public function index(){
        $users = User::whereHas('schools', fn($q) => $q->where('role', 'student'))->get();
        return view('pages.students.index', compact('users'));
    }

}
