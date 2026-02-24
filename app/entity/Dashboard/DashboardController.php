<?php

namespace App\entity\Dashboard;

use App\entity\cohort\Cohort;
use App\entity\user\User;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        $current_school_id = auth()->user()->current_school_id;
        $cohorts = Cohort::forSchool($current_school_id)->take(5)->get();
        $teachers = User::getUserByRole($current_school_id, 'teacher')->take(5)->get();
        $students = User::getUserByRole($current_school_id, 'student')->take(5)->get();
        return view('pages.dashboard.index', compact('cohorts', 'teachers', 'students'));
    }
}
