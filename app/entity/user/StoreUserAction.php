<?php

namespace App\entity\user;

use Illuminate\Support\Facades\Hash;

class StoreUserAction
{
    public function execute(UserDTO $dto): User
    {

        $school = auth()->user()->schools()->first();

        $user = User::create([
            'last_name' => $dto->last_name,
            'first_name' => $dto->first_name,
            'email' => $dto->email,
            'password' => Hash::make($dto->password),
        ]);

        return $user;
    }
}
