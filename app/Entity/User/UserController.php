<?php

namespace App\Entity\User;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function store(userRequest $request, StoreUserAction $action)
    {
        $dto = UserDTO::fromRequest($request);
        $user = $action->execute($dto);

        return response()->json([
            'user' => $user,
            'redirect' => route('pages.teachers.index'),
        ]);
    }
}
