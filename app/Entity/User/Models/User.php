<?php

namespace App\Entity\User\Models;

use App\Entity\Cohort\Models\Cohort;
use App\Entity\Models\Ratings;
use App\Entity\School\Models\School;
use Database\Factories\Entity\User\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Modèle central représentant un utilisateur de l'application.
 */
class User extends Authenticatable
{
    use HasFactory;

    // Spécifie la factory à utiliser pour ce modèle
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

    // Accessors pour obtenir le nom complet de l'utilisateur
    public function getFullNameAttribute(): string
    {
        return $this->last_name . ' ' . $this->first_name;
    }

    // Retourne le nom court de l'utilisateur 
    public function getShortNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name[0] . '.';
    }

    // Retourne l'URL de la photo de profil de l'utilisateur ou une image par défaut
    public function getProfilePhotoUrlAttribute(): string
    {
        return $this->profile_photo_path
            ? asset('storage/' . $this->profile_photo_path)
            : asset('images/user/owner.png');
    }

    // Relations avec les autres modèles (Écoles auxquelles l'utilisateur appartient)
    public function schools()
    {
        return $this->belongsToMany(School::class, 'users_schools', 'user_id', 'school_id')
            ->withPivot('role');
    }

    // Relations avec les autres modèles (Tâches assignées à l'utilisateur)
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_user')
            ->withPivot('completed', 'comment')
            ->withTimestamps();
    }

    // Relations avec les autres modèles (Évaluations associées à l'utilisateur)
    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    // // Relations avec les autres modèles (Cohorts auxquelles l'utilisateur appartient)
    public function cohorts()
    {
        return $this->belongsToMany(Cohort::class, 'cohort_user');
    }

    // Retourne le rôle de l'utilisateur dans une école donnée
    public function roleInSchool($schoolId)
    {
        $school = $this->schools()->where('school_id', $schoolId)->first();

        return $school?->pivot?->role;
    }

    // Vérifie si l'utilisateur a un rôle spécifique dans une école donnée
    public function hasRoleInSchool(string $role, int $schoolId): bool
    {
        return $this->roleInSchool($schoolId) === $role;
    }

    // Relations avec les autres modèles (Notes associées à l'utilisateur)
    public function ratings()
    {
        return $this->belongsToMany(Ratings::class, 'users_ratings', 'user_id', 'rating_id')
            ->withPivot('tests');
    }
}
