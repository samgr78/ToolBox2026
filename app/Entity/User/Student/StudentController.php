<?php

namespace App\Entity\User\Student;

use App\Http\Controllers\Controller;
use App\Queries\UserQuery;

/**
 * Contrôleur dédié à la liste des étudiants.
 */
class StudentController extends Controller
{
    /**
     * Affiche la liste des étudiants de l'établissement de l'utilisateur connecté.
     * Récupère tous les utilisateurs ayant le rôle "student" dans l'établissement de l'utilisateur connecté et les passe à la vue.
     */
    public function index(){
        $users = UserQuery::forSchool(auth()->user()->current_school_id)->forRole('student')->get();
        return view('pages.students.index', compact('users'));
    }
}
