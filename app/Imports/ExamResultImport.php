<?php

namespace App\Imports;

use App\Models\ExamResult;
use App\Models\ExamSubject;
use App\Models\Grading;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ExamResultImport implements ToModel, WithStartRow, WithHeadingRow, WithMultipleSheets
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($row["marks"] !=  '' && $row["subject"] != '' && $row['studentid'] != '' && $row['exam'] != '') {
            $subject = ExamSubject::where(['subject_id' => $row["subject"], 'exam_group_item_id' => $row["exam"]])->get();
            $min_marks = isset($subject[0]) ? $subject[0]->min_marks : 'x';
            $max_marks = isset($subject[0]) ? $subject[0]->max_marks : 'x';

            if ($min_marks == 'x' || $max_marks == '') {
                return   redirect()->back()->with('error', 'Invalid Subject');
            }
            
            if (($row["marks"] < $min_marks) || ($row["absent"] == "yes")) {
                $status = 0;
            } else {
                $status = 1;
            }
            $grading_id = ($row["absent"] == "yes")  ? Grading::get_grading_id(0, $max_marks) : Grading::get_grading_id((int)$row["marks"], $max_marks);
            return new ExamResult([
                'exam_group_item_id' => $row["exam"],
                'student_id' => $row["studentid"],
                'subject_id' => $row["subject"],
                'marks' => $row["marks"],
                'note' => $row["note"],
                'is_absent' => ($row["absent"] == "yes") ? 1 : 0,
                "status" => $status,
                'grading_id' => $grading_id
            ]);
        }
        return redirect()->back()->with('error', 'Some rows are not inserted, for incorrect format!');
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function startRow(): int
    {
        return 3;
    }

    public function headingRow(): int
    {
        return 2;
    }

    public function sheets(): array
    {
        return [
            0 => new self(),
        ];
    }
}
