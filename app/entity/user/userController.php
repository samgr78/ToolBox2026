<?php

namespace App\entity\user;

use App\Http\Controllers\Controller;

class userController extends Controller
{
    public function store(userRequest $request, StoreUserAction $action)
    {
        $dto = userDTO::fromRequest($request);
        $user = $action->execute($dto);

        return response()->json([
            'user' => $user,
            'redirect' => route('teachers.index'),
        ]);
    }
}
