<?php

namespace App\Entity\Profile\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'last_name'  => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', Rule::unique('users')->ignore(auth()->id())],
            'password'   => ['nullable', 'string', 'min:6'],
        ];
    }
}
