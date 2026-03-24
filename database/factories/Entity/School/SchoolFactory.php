<?php

namespace Database\Factories\Entity\School;

use App\Entity\School\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolFactory extends Factory
{
    protected $model = School::class;
    public function definition(): array
    {
        return [
            'user_id'     => null,
            'name'        => fake()->company(),
            'description' => fake()->sentence(),
        ];
    }
}
