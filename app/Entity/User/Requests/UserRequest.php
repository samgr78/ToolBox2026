<?php

namespace App\Entity\User\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * FormRequest gérant la validation des données utilisateur.
 */
class UserRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette requête.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Règles de validation pour les données utilisateur.
     */
    public function rules(): array
    {
        $user = $this->route('user');
        $userId = $user?->id;

        return [
            'last_name'  => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($userId)],
            'password'   => [$userId ? 'nullable' : 'required', 'string', 'min:4'],
            'role' => [$userId ? 'nullable' : 'required', 'string', 'in:student,teacher,admin'],
        ];
    }
}
