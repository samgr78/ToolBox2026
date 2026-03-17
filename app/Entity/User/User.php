<?php

namespace App\Entity\User;

use App\Builders\UserBuilder;
use App\Entity\Cohort\Cohort;
use App\Entity\School\School;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'last_name',
        'first_name',
        'email',
        'password',
        'current_school_id',
        'profile_photo_path',
    ];

    public function newEloquentBuilder($query)
    {
        return new UserBuilder($query);
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getFullNameAttribute(): string
    {
        return $this->last_name . ' ' . $this->first_name;
    }

    public function getShortNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name[0] . '.';
    }

    public function getProfilePhotoUrlAttribute(): string
    {
        return $this->profile_photo_path
            ? asset('storage/' . $this->profile_photo_path)
            : asset('images/default-avatar.png');
    }

    public function schools()
    {
        return $this->belongsToMany(School::class, 'users_schools', 'user_id', 'school_id')
            ->withPivot('role');
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_user')
            ->withPivot('completed', 'comment')
            ->withTimestamps();
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    public function cohorts()
    {
        return $this->belongsToMany(Cohort::class, 'cohort_user');
    }

    public function roleInSchool($schoolId)
    {
        $school = $this->schools()->where('school_id', $schoolId)->first();

        return $school?->pivot?->role;
    }

    public function hasRoleInSchool(string $role, int $schoolId): bool
    {
        return $this->roleInSchool($schoolId) === $role;
    }
}
