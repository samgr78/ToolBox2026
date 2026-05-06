<?php

namespace App\Imports;

use App\Entity\User\Models\User;
use App\Entity\Models\Ratings;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersRateImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $user = User::firstOrCreate(
                [
                    'last_name'    => $row['nom'],
                    'first_name' => $row['prenom'],
                    'email' => strtolower($row['prenom'] . '.' . $row['nom'] . '@esiee-it.fr'),
                    'password' => bcrypt('password123'),
                ],
            );

            $note = Ratings::create([
                'rate' => $row['note'],
                'tests' => $row['Evaluation'],
            ]);

            $user->rating()->attach($note->id);
        }
    }
}
