<?php

namespace App\entity\user;

readonly class userDTO
{
    public function __construct(

    ) {
    }

    public static function fromRequest(userRequest $request): userDTO
    {
        return new self(

        );
    }
}
