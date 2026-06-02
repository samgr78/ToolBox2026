<?php

namespace App\Entity\User\Teacher;

use App\Http\Controllers\Controller;
use App\Queries\UserQuery;

/**
 * Contrôleur dédié à la liste des enseignants.
 */
class TeacherController extends Controller
{
    /**
     * Affiche la liste des enseignants de l'établissement de l'utilisateur connecté.
     * Récupère tous les utilisateurs ayant le rôle "teacher" dans l'établissement de l'utilisateur connecté et les passe à la vue.
     */
    public function index(){
        $users = UserQuery::forSchool(auth()->user()->current_school_id)->forRole('teacher')->get();
        return view('pages.teachers.index', compact('users'));
    }
}
