<?php

namespace App\Entity\Cohort\DTO;

use App\Entity\Cohort\Requests\cohortRequest;

/**
 * Data Transfer Object représentant les données d'une cohort.
 */
readonly class CohortDTO
{
    // Constructeur de la classe CohortDTO.
    public function __construct(
        public string $name,
        public string $description,
        public string $start_date,
        public string $end_date,
    ) {
    }

    // Construit le DTO depuis une requête déjà validée
    public static function fromRequest(cohortRequest $request): cohortDTO
    {
        return new self(
            name: $request->input('name'),
            description: $request->input('description'),
            start_date: $request->input('start_date'),
            end_date: $request->input('end_date'),
        );
    }
}
