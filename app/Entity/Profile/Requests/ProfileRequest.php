<?php

namespace App\Entity\Profile\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * FormRequest dédié à la validation des données de mise à jour du profil utilisateur.
*/
class ProfileRequest extends FormRequest
{
    /**
     * Tout utilisateur authentifié peut mettre à jour son propre profil.
     */
    public function authorize(): bool { return true; }

    /**
     * Règles de validation du formulaire de profil.
     */
    public function rules(): array
    {
        return [
            'last_name'  => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', Rule::unique('users')->ignore(auth()->id())],
            'password'   => ['nullable', 'string', 'min:6', 'confirmed'],
            'current_password' => ['required_with:password', 'current_password'],
        ];
    }
}
