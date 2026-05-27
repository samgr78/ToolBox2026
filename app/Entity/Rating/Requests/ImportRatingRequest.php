<?php

namespace App\Http\Requests\Rating;

use Illuminate\Foundation\Http\FormRequest;

class ImportRatingRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fichier_excel' => 'required|mimes:xlsx,csv|max:10240',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'fichier_excel.required' => 'Le fichier Excel est requis.',
            'fichier_excel.mimes' => 'Le fichier doit être au format .xlsx ou .csv.',
            'fichier_excel.max' => 'Le fichier ne peut pas dépasser 10 Mo.',
        ];
    }
}
