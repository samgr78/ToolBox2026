<?php

namespace App\Entity\Profile\Actions;

use App\Entity\Profile\DTO\ProfileDTO;
use App\Entity\User\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UpdateProfileAction
{
    public function execute(ProfileDTO $dto, User $user): User
    {
        return DB::transaction(function () use ($dto, $user) {
            $data = [
                'last_name'  => $dto->last_name,
                'first_name' => $dto->first_name,
                'email'      => $dto->email,
            ];

            if ($dto->password) {
                $data['password'] = Hash::make($dto->password);
            }

            $user->update($data);
            return $user;
        });
    }
}
