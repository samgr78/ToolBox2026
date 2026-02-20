<?php

namespace App\entity\Dashboard;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        $cohorts = auth()->user()->cohorts()->get();
        return view('pages.dashboard.index', compact('cohorts'));
    }
}
