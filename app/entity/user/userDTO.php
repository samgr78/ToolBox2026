<?php

namespace App\entity\user;

readonly class userDTO
{
    public function __construct(
        public string $first_name,
        public string $last_name,
        public string $email,
        public string $password,
    ) {
    }

    public static function fromRequest(userRequest $request): userDTO
    {
        return new self(
            first_name: $request->input('first_name'),
            last_name: $request->input('last_name'),
            email: $request->input('email'),
            password: $request->input('password'),
        );
    }
}
