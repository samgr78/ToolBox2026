<?php

namespace App\Entity\Profile\Actions;

use App\Entity\Profile\DTO\ProfileDTO;
use App\Entity\User\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

/**
 * Action dédiée à la mise à jour du profil utilisateur.
 */
class UpdateProfileAction
{
    /**
     * Met à jour les informations du profil d'un utilisateur.
     * @param ProfileDTO $dto  Données validées issues du formulaire
     * @param User       $user Utilisateur à mettre à jour
     */
    public function execute(ProfileDTO $dto, User $user): User
    {
        return DB::transaction(function () use ($dto, $user) {
            $data = [
                'last_name'  => $dto->last_name,
                'first_name' => $dto->first_name,
                'email'      => $dto->email,
            ];

            // Si un nouveau mot de passe est fourni, le hacher avant de le stocker
            if ($dto->password) {
                $data['password'] = Hash::make($dto->password);
            }

            $user->update($data);
            return $user;
        });
    }
}
