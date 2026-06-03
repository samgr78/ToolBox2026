<?php

namespace App\Entity\Dashboard\Controllers;

use App\Queries\CohortQuery;
use App\Queries\UserQuery;
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
        $cohorts = CohortQuery::forSchool($current_school_id)
            ->get()
            ->map(function ($cohort) {
                $cohort->students_count = $cohort->students()->count();
                return $cohort;
            })
            ->take(5);

        // Récupérer les 5 derniers enseignants et les promotions associées
        $teachers = UserQuery::forSchool($current_school_id)->forRole('teacher')
            ->get()
            ->map(function ($teacher) {
                $teacher->cohorts_count = $teacher->cohorts()->count();
                return $teacher;
            })
            ->take(5);

        // Récupérer les 5 derniers étudiants    
        $students = UserQuery::forSchool($current_school_id)->forRole('student')
            ->get()
            ->take(5);

        //  Vérifier si l'utilisateur connecté est un étudiant
        $isStudent = UserQuery::forSchool($current_school_id)
            ->userHasRole(auth()->user(), 'student');

        return view('pages.dashboard.index', compact('cohorts', 'teachers', 'students', 'isStudent'));
    }
}
