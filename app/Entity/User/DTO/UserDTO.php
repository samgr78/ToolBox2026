<?php

namespace App\Entity\User\DTO;

use App\Entity\User\Requests\userRequest;

/**
 * Data Transfer Object représentant les données d'un utilisateur.
 */
readonly class UserDTO
{
    // Propriétés représentant les données d'un utilisateur
    public function __construct(
        public string $last_name,
        public string $first_name,
        public string $email,
        public ?string $password,
        public ?string $role,
    ) {
    }

    // Méthode statique pour créer un UserDTO à partir d'une requête utilisateur
    public static function fromRequest(userRequest $request): UserDTO
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
