<?php

namespace App\Imports;

use App\Models\Measurement;
use App\Models\Measurements;
use Maatwebsite\Excel\Concerns\ToModel;

class MeasurementsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if($row[0] === null || $row[1] === null||$row[2] === null) {
            return null; // Skip rows with empty label or description and unit
        }
        return new Measurements([
            'label' => $row[0],
            'description' => $row[1]??null,
            'unit' => $row[2]??null,
        ]);
    }
}
