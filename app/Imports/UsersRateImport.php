<?php

namespace App\Imports;

use App\Entity\User\Models\User;
use App\Entity\Models\Ratings;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows; // Pour ignorer les lignes vides

class UsersRateImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $rawNote = $row['notes'];
            $noteValue = is_string($rawNote) && str_contains($rawNote, '/')
                ? explode('/', $rawNote)[0]
                : $rawNote;

            $email = strtolower($row['prenom'] . '.' . $row['nom'] . '@esiee-it.fr');

            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'last_name'  => $row['nom'],
                    'first_name' => $row['prenom'],
                    'password'   => Hash::make('password123'),
                ]
            );

            $note = Ratings::create([
                'rate' => (float) $noteValue
            ]);

            $testName = $row['evaluations'] ?? 'Import automatique';
            $user->ratings()->attach($note->id, ['tests' => $testName]);
        }
    }
}
