<?php

namespace App\Entity\Rating\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\UsersRateImport;
use App\Imports\UsersRatePreviewImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Contrôleur gérant l'import de fichiers Excel pour la notation des utilisateurs.
 */
class RatingController extends Controller
{
    public function index(){
        return view('rating.index');
    }

    /**
     * Permet de prévisualiser le contenu d'un fichier Excel sans l'importer en bdd.
     * @param Request $request  Doit contenir 'fichier_excel' (xlsx ou csv)
     */
    public function preview(Request $request){

        // Validation pour éviter les uploads malveillants
        $request->validate([
            'fichier_excel' => 'required|mimes:xlsx,csv'
        ]);

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

    /**
     * Importe les données du fichier Excel en bdd.
     * @param Request $request  Doit contenir 'fichier_excel' (xlsx ou csv)
     */
    public function import(Request $request){
        $request->validate([
            'fichier_excel' => 'required|mimes:xlsx,csv'
        ]);

        try {
            Excel::import(new UsersRateImport, $request->file('fichier_excel'));
            return back()->with('success', 'Import réussi!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de l\'import: ' . $e->getMessage());
        }
    }

}