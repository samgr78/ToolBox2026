<?php

namespace App\Entity\User;

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
        $user = $action->execute($dto);

        return response()->json([
            'success' => true,
            'html' => $results['html'],
        ]);
    }

    public function update(UserRequest $request, UpdateUserAction $action, User $user)
    {
        $dto = UserDTO::fromRequest($request);
        $user = $action->execute($dto, $user);

        return response()->json([
            'success' => true,
            'user' => $user,
        ]);
    }

    public function destroy(User $user)
{
    $this->authorize('delete', $user);
    $user->delete();

    return redirect()->back()->with('success', 'Utilisateur supprimé.');
}
}
