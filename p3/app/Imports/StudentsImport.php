<?php

namespace App\Imports;

use App\Student;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Student([
            'firstName' => $row[0],
            'lastName' => $row[1],
            'homeroom' => $row[2],
            'streetAddress' => $row[3],
        ]);
    }
}
