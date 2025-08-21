<?php

namespace App\Imports;

use App\Models\Garment;
use Maatwebsite\Excel\Concerns\ToModel;

class GarmentsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if($row[0] === null || $row[1] === null) {
            return null; // Skip rows with empty name or description
        }
        return new Garment([
            'name' => $row[0],
            'description' => $row[1]??null,
        ]);
    }
}
