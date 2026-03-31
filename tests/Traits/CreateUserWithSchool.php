<?php

namespace Tests\Traits;

use App\Entity\Models\UserSchool;
use App\Entity\School\Models\School;
use App\Entity\User\Models\User;

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
