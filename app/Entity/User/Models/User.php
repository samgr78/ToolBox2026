<?php

namespace App\Entity\User\Models;

use App\Entity\Cohort\Models\Cohort;
use App\Entity\Models\Ratings;
use App\Entity\School\Models\School;
use Database\Factories\Entity\User\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }

    protected $fillable = [
        'last_name',
        'first_name',
        'email',
        'password',
        'current_school_id',
        'profile_photo_path',
    ];

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
            : asset('images/user/owner.png');
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

    public function ratings()
    {
        return $this->belongsToMany(Ratings::class, 'users_ratings', 'user_id', 'rating_id')
            ->withPivot('tests');
    }
}
