<?php

namespace App\Entity\User\Controllers;

use App\Entity\User\Actions\StoreUserAction;
use App\Entity\User\Actions\UpdateUserAction;
use App\Entity\User\DTO\UserDTO;
use App\Entity\User\Models\User;
use App\Entity\User\Requests\userRequest;
use App\Http\Controllers\Controller;

/**
 * Contrôleur gérant les opérations CRUD sur les utilisateurs.
*/
class UserController extends Controller
{

    // Affiche les détails d'un utilisateur spécifique
    public function show(User $user)
    {
        $this->authorize('view', $user);
        return view('pages.students.show', compact('user'));
    }

    // Affiche le formulaire de création d'un nouvel utilisateur
    public function store(userRequest $request, StoreUserAction $action)
    {
        $this->authorize('create', User::class);
        $dto = UserDTO::fromRequest($request);
        $result = $action->execute($dto);

        return response()->json([
            'success' => true,
            'html' => $result['html'],
        ]);
    }

    // Affiche le formulaire de modification d'un utilisateur existant
    public function update(UserRequest $request, UpdateUserAction $action, User $user)
    {
        $this->authorize('update', $user);
        $dto = UserDTO::fromRequest($request);
        $result = $action->execute($dto, $user);

        return response()->json([
            'success' => true,
            'user' => $result['html'],
        ]);
    }

    // Supprime un utilisateur existant
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->schools()->detach();
        $user->delete();

        return response()->json([
            'success' => true,
            'customEvent' => 'User.Deleted',
        ]);
    }
}
