<?php

namespace App\Entity\Rating\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\UsersRateImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RatingController extends Controller
{
    public function index(){
        return view('rating.index');
    }

    public function import(Request $request){
        $request->validate([
            'fichier_excel' => 'required|mimes:xlsx'
        ]);

        Excel::import(new UsersRateImport, $request->file('fichier_excel'));

        return back()->with('success');
    }

}
