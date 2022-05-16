<?php

namespace App\Import;

use App\Models\Equipment;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Validation\Rule;

class CSVImport implements ToModel, WithValidation, WithStartRow
{

    use Importable;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    // public function __construct($csvData)
    // {
    //     $this->csvData = $csvData;
    // }

    /**
     * method used to import csv files
     *
     */

    public function model(array $row){
        return $equipment = Equipment::updateOrCreate(
        [
            'point_id' => $row[0]
        ],
        [
            // 'point_id'              => $row[0],
            'site'                  => $row[1],
            'area'                  => $row[2],
            'unit'                  => $row[3],
            'equipment'             => $row[4],
            'description'           => $row[5],
            'fluid_in_use'          => $row[6],
            'fluid_grade'           => $row[7],
            'equipment_type'        => $row[8],
            'recent_sample'         => $row[9],
            'last_sample_date'      => $row[10]
        ]);
    }

    /**
     * rules for each row
     */

    public function rules(): array
    {
        return [
            '*.0'                   => 'required',
            '*.1'	                => 'required|max:255',
            '*.2'	                => 'required|max:255',
            '*.3'	                => 'required|max:255',
            '*.4'	                => 'required|max:255',
            '*.5'	                => 'required|max:255',
            '*.6'	                => 'nullable|max:255',
            '*.7'	                => 'nullable|max:255',
            '*.8'	                => 'nullable|max:255',
            '*.9'	                => 'required|max:255',
            '*.10'                  => 'required|max:255'
        ];
    }

    /**
     * @return array
     */
    public function customValidationAttributes()
    {
        return [
            '0' => 'point id',
            '1' => 'site',
            '2' => 'area',
            '3' => 'unit',
            '4' => 'equipment',
            '5' => 'description',
            '6' => 'fluid in use',
            '7' => 'fluid grade',
            '8' => 'equipment type',
            '9' => 'most recent sample',
            '10' => 'last sample date',
        ];
    }

    public function startRow(): int
    {
        return 2;
    }
}
