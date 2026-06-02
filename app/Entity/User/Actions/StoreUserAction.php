<?php

namespace App\Entity\User\Actions;

use App\Entity\Models\UserSchool;
use App\Entity\User\DTO\UserDTO;
use App\Entity\User\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

/**
 * Action responsable de la création d'un nouvel utilisateur
 */
class StoreUserAction
{
    public function execute(UserDTO $dto): array
    {
        return DB::transaction(function () use ($dto){

            // Récupérer l'établissement de l'utilisateur connecté
            $school = auth()->user()->schools()->first();

            // Créer l'utilisateur
            $user = User::create([
                'last_name' => $dto->last_name,
                'first_name' => $dto->first_name,
                'email' => $dto->email,
                'password' => Hash::make($dto->password),
            ]);

            // Associer l'utilisateur à l'établissement avec le rôle spécifié
            $role = UserSchool::create([
                'user_id' => $user->id,
                'school_id' => $school->id,
                'role' => $dto->role,
            ]);

            // Générer le HTML de la nouvelle ligne du tableau en fonction du rôle de l'utilisateur
            if ($dto->role === 'student') {
                $html = view('pages.students.partials.students-table-row', [
                    'user' => $user,
                ])->render();
            }
            else{
                $html = view('pages.teachers.partials.teachers-table-row', [
                    'user' => $user,
                ])->render();
            }

            return [
                'html'  => $html,
                'data'  => $user,
            ];
        });
    }

}
