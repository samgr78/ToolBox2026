<?php

namespace App\Entity\User;

use App\Entity\UserSchool;
use Illuminate\Support\Facades\Hash;
use Nette\Utils\ArrayList;
use app\Queries\UserQuery;

class StoreUserAction
{
    public function execute(UserDTO $dto): array
    {


        $school = auth()->user()->schools()->first();

        $user = User::create([
            'last_name' => $dto->last_name,
            'first_name' => $dto->first_name,
            'email' => $dto->email,
            'password' => Hash::make($dto->password),
        ]);

        $role = UserSchool::create([
            'user_id' => $user->id,
            'school_id' => $school->id,
            'role' => $dto->role,
        ]);

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
    }
}
