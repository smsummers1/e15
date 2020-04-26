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
            'student_name' => $row[0],
            'volunteer_hours' => $row[1],
            'homeroom' => $row[2],
            'street_address' => $row[3],
        ]);
    }
}
