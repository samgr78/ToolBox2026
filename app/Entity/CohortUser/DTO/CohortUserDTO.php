<?php

namespace App\Entity\CohortUser\DTO;

use App\Entity\CohortUser\Requests\CohortUserRequest;

readonly class CohortUserDTO
{
    public function __construct(
        public string $name,
        public string $description,
        public string $start_date,
        public string $end_date,
    ) {
    }

    public static function fromRequest(CohortUserRequest $request): CohortUserDTO
    {
        return new self(
            name: $request->input('name'),
            description: $request->input('description'),
            start_date: $request->input('start_date'),
            end_date: $request->input('end_date'),
        );
    }
}
