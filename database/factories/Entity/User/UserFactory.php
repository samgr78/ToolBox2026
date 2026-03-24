<?php

namespace Database\Factories\Entity\User;

use App\Entity\User\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;
    public function definition(): array
    {
        return [
            'last_name'         => fake()->lastName(),
            'first_name'        => fake()->firstName(),
            'email'             => fake()->unique()->safeEmail(),
            'password'          => Hash::make('password'),
            'current_school_id' => null,
        ];
    }
}
