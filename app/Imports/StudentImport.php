<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Student([
            'fullname' => $row['fullname'],
            'gender' => $row['gender'],
            'guardian_id' => $row['guardian_id'],
            'date_of_birth' => $this->transformDate($row['date_of_birth']),
            'joined_date' =>  $this->transformDate($row['joined_date']),
            'student_address_id' => $row['address'],
            'blood_group_id' => $row['blood_group_id'],
            'has_medical_emergency' => $row['has_medical_emergency'],
            'is_active' => $row['is_active'],
            'is_graduated' => $row['is_graduated'],
            'fee_amount' => $row['fee_amount'],
            'fee_balance' => $row['fee_balance'],
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }
}
