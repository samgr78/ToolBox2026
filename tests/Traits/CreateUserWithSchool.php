<?php

namespace Tests\Traits;

use App\Entity\School\School;
use App\Entity\User\User;
use App\Entity\UserSchool;

trait CreateUserWithSchool
{
    protected function createUserWithSchool(string $role = 'admin'): array
    {

        $user = User::factory()->create();

        $school = School::factory()->create([
            'user_id' => $user->id,
        ]);

        $user->update(['current_school_id' => $school->id]);

        UserSchool::create([
            'user_id'   => $user->id,
            'school_id' => $school->id,
            'role'      => $role,
        ]);

        return [$user, $school];
    }
}
