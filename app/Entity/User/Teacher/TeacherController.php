<?php

namespace App\Entity\User\Teacher;

use App\Http\Controllers\Controller;
use App\Entity\User\User;

class TeacherController extends Controller
{
    public function index(){
        $users = User::whereHas('schools', fn($q) => $q->where('role', 'teacher'))->get();
        return view('pages.teachers.index', compact('users'));
    }
    
}
