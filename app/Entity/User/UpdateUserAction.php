<?php

namespace App\Entity\User;

class UpdateUserAction
{
    public function execute(UserDTO $dto, User $user): User
    {
        $user->update([
            'last_name'=> $dto->last_name,
            'first_name'=> $dto->first_name,
            'email'=> $dto->email,
            'password'=> $dto->password,
        ]);

        return $user;
    }
}