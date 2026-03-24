<?php

namespace App\Entity\User\Controllers;

use App\Entity\User\Actions\StoreUserAction;
use App\Entity\User\Actions\UpdateUserAction;
use App\Entity\User\DTO\UserDTO;
use App\Entity\User\Models\User;
use App\Entity\User\Requests\userRequest;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function show(User $user)
    {
        $this->authorize('view', $user);
        return view('pages.users.show', compact('user'));
    }

    public function store(userRequest $request, StoreUserAction $action)
    {
        $dto = UserDTO::fromRequest($request);
        $result = $action->execute($dto);

        return response()->json([
            'success' => true,
            'html' => $result['html'],
        ]);
    }

    public function update(UserRequest $request, UpdateUserAction $action, User $user)
    {
        $dto = UserDTO::fromRequest($request);
        $result = $action->execute($dto, $user);

        return response()->json([
            'success' => true,
            'user' => $result['html'],
        ]);
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->schools()->detach();
        $user->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
