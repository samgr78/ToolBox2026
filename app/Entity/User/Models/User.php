<?php

namespace App\Entity\User\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Builders\UserBuilder;
use App\Entity\Cohort\Models\Cohort;
use App\Entity\School\Models\School;
use App\Entity\User\Assessment;
use App\Entity\User\Task;
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

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'last_name',
        'first_name',
        'email',
        'password',
        'current_school_id',
    ];

    public function newEloquentBuilder($query){
        return new UserBuilder($query);
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * This function returns the full name of the connected user
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return $this->last_name . ' ' . $this->first_name;
    }

    /**
     * This function returns the short name of the connected user
     * @return string
     */
    public function getShortNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name[0] . '.';
    }

    /**
     * Retrieve the school of the user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function schools() {
        return $this->belongsToMany(School::class, 'users_schools', 'user_id', 'school_id')
            ->withPivot('role');
    }

    /**
     * Relation Many-to-Many with tasks
     */
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_user')
            ->withPivot('completed', 'comment')
            ->withTimestamps();
    }

    /**
     * Relation One-to-Many with assessments
     */
    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    /**
     * Relation Many-to-Many with cohort
     */

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
