<?php

namespace App\Import;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Validation\Rule;

class UsersImport implements ToModel, WithValidation, WithStartRow
{
    use Importable;
    /**
     * Create a new message instance.
     *
     * @return void
     */

    /**
     * method used to import csv files
     *
     */

    public function model(array $row)
    {
        return $user = User::create([
            'mrt_id'        => $row[0],
            'name'          => $row[1],
            'email'         => $row[2],
            'company'       => $row[3],
            'phone'         => $row[4],
            'address1'      => $row[5],
            'address2'      => $row[6],
            'city'          => $row[7],
            'state'         => $row[8],
            'zip'           => $row[9],
            'country'       => $row[10],
            'notes'         => $row[11]
        ]);
    }

    /**
     * rules for each row
     */

    public function rules(): array
    {
        return [
            '*.0'                   => 'required|max:7',
            '*.1'	                => 'nullable|max:255',
            '*.2'	                => 'nullable|max:255',
            '*.3'	                => 'nullable|max:255',
            '*.4'	                => 'nullable|max:255',
            '*.5'	                => 'nullable|max:255',
            '*.6'	                => 'nullable|max:255',
            '*.7'	                => 'nullable|max:255',
            '*.8'	                => 'nullable|max:255',
            '*.9'	                => 'nullable|max:255',
            '*.10'                  => 'nullable|max:255',
            '*.11'                  => 'nullable|max:500'
        ];
    }

    /**
     * @return array
     */
    public function customValidationAttributes()
    {
        return [
            '0' => 'mrt_id',
            '1' => 'name',
            '2' => 'email',
            '3' => 'company',
            '4' => 'phone',
            '5' => 'address1',
            '6' => 'address2',
            '7' => 'city',
            '8' => 'state',
            '9' => 'zip',
            '10' => 'country',
            '11' => 'notes',
        ];
    }

    public function startRow(): int
    {
        return 2;
    }
}
