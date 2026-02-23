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
        $teachers = User::getTeacher($current_school_id)->take(5)->get();
        return view('pages.dashboard.index', compact('cohorts', 'teachers'));
    }
}
