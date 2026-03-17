<?php

namespace App\Entity\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
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
            'role'       => ['required', 'string', 'in:student,teacher,admin'],
        ];
    }
}
