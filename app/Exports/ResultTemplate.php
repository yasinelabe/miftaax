<?php

namespace App\Exports;

use App\Models\ClassRoom;
use App\Models\Exam;
use App\Models\ExamGroupItem;
use App\Models\Subject;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ResultTemplate implements FromArray, WithHeadings

{
    use Exportable;

    public function __construct($subject,$year,$exam_item)
    {
        $this->subject = Subject::find($subject);
        $this->year = $year;
        $this->exam_item = ExamGroupItem::find($exam_item);
    }

    public function array() : array
    {
        $students = $this->exam_item->exam_students;
        $output = [];
        foreach ($students as $student) :
            array_push($output,[$student->student_id, $student->fullname, $this->exam_item->id,$this->subject->id,'','pass or fail','yes or no']);
        endforeach;
        return $output;
    }


    public function headings(): array
    {
        return [
            ['Year: '.$this->year,'Exam: '.$this->exam_item->exam->name, 'Subject: '.$this->subject->name ],
            ['StudentID','Student Name','Exam','Subject','Marks','note','absent']
        ];
    }

    
}