<?php

namespace App\Entity\User;

readonly class userDTO
{
    public function __construct(
        public string $last_name,
        public string $first_name,
        public string $email,
        public string $password,
        public string $role,
    ) {
    }

    public static function fromRequest(userRequest $request): userDTO
    {
        return new self(
            last_name: $request->input('last_name'),
            first_name: $request->input('first_name'),
            email: $request->input('email'),
            password: $request->input('password'),
            role: $request->input('role'),
        );
    }
}
