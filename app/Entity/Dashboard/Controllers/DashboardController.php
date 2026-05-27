<?php

namespace App\Entity\Dashboard\Controllers;

use App\Entity\Cohort\Models\Cohort;
use App\Entity\User\Models\User;
use App\Http\Controllers\Controller;

/**
 * Contrôleur du tableau de bord.
 */
class DashboardController extends Controller
{
    /**
     * Affiche le tableau de bord de l'établissement de l'utilisateur connecté.
     * Récupère les 5 dernières promotions, les 5 derniers enseignants et les 5 derniers étudiants de l'établissement.
     */
    public function index(){
        $current_school_id = auth()->user()->current_school_id;

        // Récupérer les 5 dernières promotions avec le nombre d'étudiants dans chaque promotion
        $cohorts = Cohort::forSchool($current_school_id)
            ->withCount('users as students_count')
            ->take(5)
            ->get();

        // Récupérer les 5 derniers enseignants et les promotions associées
        $teachers = User::getUserByRole($current_school_id, 'teacher')
            ->withCount('cohorts as cohorts_count')
            ->take(5)
            ->get();

        // Récupérer les 5 derniers étudiants    
        $students = User::getUserByRole($current_school_id, 'student')
            ->take(5)
            ->get();

        return view('pages.dashboard.index', compact('cohorts', 'teachers', 'students'));
    }
}
