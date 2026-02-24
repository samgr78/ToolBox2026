<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class UserBuilder extends Builder
{
    public function getTeacher(int $schoolId){
        return $this->whereHas('schools', function ($query) use ($schoolId) {
            $query->where('schools.id', $schoolId)
                ->where('users_schools.role', 'teacher');
        });
    }

    public function getUserByRole(int $schoolId, string $role){
        return $this->whereHas('schools', function ($query) use ($role, $schoolId) {
            $query->where('schools.id', $schoolId)
                ->where('users_schools.role', $role);
        });
    }
}
