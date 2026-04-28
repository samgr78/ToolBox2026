<?php

namespace App\Entity\Profile\Controllers;

use App\Entity\Profile\Actions\UpdateAccountAction;
use App\Entity\Profile\DTO\AccountDTO;
use App\Entity\Profile\Requests\AccountRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        return view('pages.profile.index', compact('user'));
    }

    public function update(AccountRequest $request, UpdateAccountAction $action): JsonResponse
    {
        $dto = AccountDTO::fromRequest($request);
        $action->execute($dto, auth()->user());

        return response()->json([
            'success' => true,
            'message' => 'Profil mis à jour avec succès !'
        ]);
    }
}
