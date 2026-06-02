<?php

namespace App\Entity\User\Actions;

use App\Entity\User\DTO\UserDTO;
use App\Entity\User\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

/**
 * Action responsable de la mise à jour d'un utilisateur existant
 */
class UpdateUserAction
{
    public function execute(UserDTO $dto, User $user): array
    {
        return DB::transaction(function () use ($dto, $user) {

            // Préparer les données à mettre à jour
            $data = [
                'last_name'  => $dto->last_name,
                'first_name' => $dto->first_name,
                'email'      => $dto->email,
            ];

            // Si un nouveau mot de passe est fourni, le hacher et l'ajouter aux données à mettre à jour
            if ($dto->password) {
                $data['password'] = Hash::make($dto->password);
            }

            $user->update($data);

            // Si un nouveau rôle est fourni, mettre à jour le rôle de l'utilisateur dans la table pivot user_school
            if ($dto->role) {
                $user->schools()->updateExistingPivot($user->current_school_id, [
                    'role' => $dto->role,
                ]);
            }

            $user->refresh();

            // Générer le HTML de la ligne du tableau mise à jour en fonction du rôle de l'utilisateur
            if ($user->role === 'student') {
                $html = view('pages.students.partials.students-table-row', [
                    'user' => $user,
                ])->render();
            } else {
                $html = view('pages.teachers.partials.teachers-table-row', [
                    'user' => $user,
                ])->render();
            }

            return [
                'html' => $html,
                'data' => $user,
            ];
        });
    }
}
