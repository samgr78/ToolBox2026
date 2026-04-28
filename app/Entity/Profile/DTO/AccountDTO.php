<?php

namespace App\Entity\Profile\DTO;

use App\Entity\Profile\Requests\AccountRequest;

readonly class AccountDTO
{
    public function __construct(
        public string $last_name,
        public string $first_name,
        public string $email,
        public ?string $password,
    ) {
    }

    public static function fromRequest(AccountRequest $request): AccountDTO
    {
        return new self(
            last_name: $request->input('last_name'),
            first_name: $request->input('first_name'),
            email: $request->input('email'),
            password: $request->input('password'),
        );
    }
}
