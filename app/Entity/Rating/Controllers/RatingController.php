<?php

namespace App\Entity\Rating\Controllers;

use App\Http\Controllers\Controller;

class RatingController extends Controller
{
    public function index(){
        return view('rating.index');
    }
}
