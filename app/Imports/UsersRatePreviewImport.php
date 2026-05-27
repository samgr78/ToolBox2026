<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class UsersRatePreviewImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
{
    private $data = [];

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $this->data[] = $row->toArray();
        }
    }

    public function getData()
    {
        return $this->data;
    }
}
