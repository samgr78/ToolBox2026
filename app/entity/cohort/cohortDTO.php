<?php

namespace App\entity\cohort;

readonly class cohortDTO
{
    public function __construct(

    ) {
    }

    public static function fromRequest(cohortRequest $request): cohortDTO
    {
        return new self(


        );
    }
}
