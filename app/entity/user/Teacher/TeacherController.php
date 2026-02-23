<?php

namespace App\entity\user\Teacher;

use App\Http\Controllers\Controller;

class TeacherController extends Controller
{
    public function index(){
        return view('pages.teachers.index');
    }
}
