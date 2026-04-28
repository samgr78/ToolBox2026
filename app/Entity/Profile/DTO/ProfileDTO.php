<?php

namespace App\Entity\Profile\DTO;

use App\Entity\Profile\Requests\ProfileRequest;

//DTO pour transporter les données de mise à jour du profil
readonly class ProfileDTO
{
    public function __construct(
        public string $last_name,
        public string $first_name,
        public string $email,
        public ?string $password,
        //public ?string $avatar,
    ) {
    }

    public static function fromRequest(ProfileRequest $request): ProfileDTO
    {
        return new self(
            last_name: $request->input('last_name'),
            first_name: $request->input('first_name'),
            email: $request->input('email'),
            password: $request->input('password'),
            //avatar: $request->input('avatar'),
        );
    }
}
