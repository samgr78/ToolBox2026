<?php

namespace App\Entity\User\Actions;

use App\Entity\User\DTO\UserDTO;
use App\Entity\User\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UpdateUserAction
{
    public function execute(UserDTO $dto, User $user): array
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

            if ($dto->role) {
                $user->schools()->updateExistingPivot($user->current_school_id, [
                    'role' => $dto->role,
                ]);
            }

            $user->refresh();

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
