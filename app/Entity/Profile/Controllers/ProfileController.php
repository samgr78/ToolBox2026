<?php

namespace App\Entity\Profile\Controllers;

use App\Entity\Profile\Actions\UpdateProfileAction;
use App\Entity\Profile\DTO\ProfileDTO;
use App\Entity\Profile\Requests\ProfileRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    //Affiche la page de profil de l'utilisateur
    public function index(): View
    {
        $user = auth()->user();
        return view('pages.profile.index', compact('user'));
    }

    //Met à jour le profil de l'utilisateur
    public function update(ProfileRequest $request, UpdateProfileAction $action): JsonResponse
    {
        $dto = ProfileDTO::fromRequest($request);
        $action->execute($dto, auth()->user());

        return response()->json([
            'success' => true,
            'message' => 'Profil mis à jour avec succès !'
        ]);
    }
}
