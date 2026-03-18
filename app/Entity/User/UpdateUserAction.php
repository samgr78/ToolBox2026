<?php

namespace App\Entity\User;

class UpdateUserAction
{
    public function execute(UserDTO $dto, User $user): array
    {
        $user->update([
            'last_name' => $dto->last_name,
            'first_name' => $dto->first_name,
            'email' => $dto->email,
            'password' => $dto->password,
        ]);

        $user = User::where('email', $dto->email)->first();

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
    }
}
