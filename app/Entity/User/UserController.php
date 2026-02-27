<?php

namespace App\Entity\User;

use App\Http\Controllers\Controller;

class userController extends Controller
{
    public function store(userRequest $request, StoreUserAction $action)
    {
        $dto = userDTO::fromRequest($request);
        $user = $action->execute($dto);

        return response()->json([
            'user' => $user,
            'redirect' => route('pages.teachers.index'),
        ]);
    }
}
