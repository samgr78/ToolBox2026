<?php

namespace App\entity\Dashboard;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        return view('pages.dashboard.index');
    }
}
