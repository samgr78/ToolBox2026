<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

/**
 * Permet de prévisualiser le contenu d'un fichier Excel sans l'importer en bdd.
 * Collecte les données dans un tableau accessible via getData() après l'import.
 */
class UsersRatePreviewImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
{
    private $data = [];

    /**
     * Collecte les données du fichier Excel ligne par ligne.
     * @param Collection $rows  Lignes du fichier, clés issues de la ligne d'en-tête
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $this->data[] = $row->toArray();
        }
    }

    /**
     * Récupère les données collectées après l'import.
     * @return array  Tableau de tableaux associatifs [ ['nom' => ..., 'prenom' => ...], ... ]
     */
    public function getData()
    {
        return $this->data;
    }
}