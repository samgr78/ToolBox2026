<?php

namespace App\Entity\Cohort\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * FormRequest gérant la validation des données d'une cohort.
 */
class CohortRequest extends FormRequest
{
    /**
     * Tout utilisateur authentifié peut soumettre ce formulaire.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Règles de validation pour les champs d'une cohort.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:120',
            'description' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ];
    }
}
