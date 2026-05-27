<?php

namespace App\Entity\Rating\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rating\ImportRatingRequest;
use App\Imports\UsersRateImport;
use App\Imports\UsersRatePreviewImport;
use Maatwebsite\Excel\Facades\Excel;

class RatingController extends Controller
{
    public function index(){
        return view('rating.index');
    }

    public function preview(ImportRatingRequest $request)
    {
        try {
            $import = new UsersRatePreviewImport();
            Excel::import($import, $request->file('fichier_excel'));
            
            $data = $import->getData();
            
            return response()->json([
                'success' => true,
                'data' => $data,
                'count' => count($data)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la lecture du fichier: ' . $e->getMessage()
            ], 400);
        }
    }

    public function import(ImportRatingRequest $request)
    {
        try {
            Excel::import(new UsersRateImport, $request->file('fichier_excel'));
            
            return response()->json([
                'success' => true,
                'message' => 'Import réussi!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'import: ' . $e->getMessage()
            ], 400);
        }
    }

}
