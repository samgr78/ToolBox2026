<?php

namespace App\Imports;

use App\Entity\User\Models\User;
use App\Entity\Models\Ratings;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

/**
 * Importe des valeurs d'utilisateurs depuis un fichier Excel (nom, prenom, evaluations, notes).
 */
class UsersRateImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
{
    private $schoolId;

    public function __construct($schoolId = null)
    {
        $this->schoolId = $schoolId ?? auth()->user()->current_school_id;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            
            // Gérer les notes au format "14/20" ou "14"
            $rawNote = $row['notes'];
            $noteValue = is_string($rawNote) && str_contains($rawNote, '/')
                ? explode('/', $rawNote)[0]
                : $rawNote;

            // Génération automatique du mail si l'utilisateur n'existe pas déjà
            $email = strtolower($row['prenom'] . '.' . $row['nom'] . '@esiee-it.fr');

            // Créer ou récupérer l'utilisateur, si non existant, crée un mot de passe par défaut
            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'last_name'  => $row['nom'],
                    'first_name' => $row['prenom'],
                    'password'   => Hash::make('password123'),
                ]
            );

            // Ajouter l'utilisateur à la table users_schools avec le rôle 'student'
            if (!$user->schools()->where('school_id', $this->schoolId)->exists()) {
                $user->schools()->attach($this->schoolId, ['role' => 'student']);
            }

            // Ajout de la note et l'associe à son utilisateur
            $note = Ratings::create([
                'rate' => (float) $noteValue
            ]);

            // Permet de récuperer le nom de l'évaluation ou de mettre une valeur par défaut
            $testName = $row['evaluations'] ?? 'Import automatique';
            $user->ratings()->attach($note->id, ['tests' => $testName]);
        }
    }
}
