<?php

namespace App\Repositories;

use App\Models\ExamStudent;
use App\Models\ExamSubject;

class ExamGroupItemRepository
{

    function add_subjects($request): void
    {
        foreach ($request->subjects as $k => $subject) {
            // check if subject exists already
            $examsubject = ExamSubject::where('exam_group_item_id', $request->exam_group_item_id)->where('subject_id', $subject)->get();
            $date = 'date_' . $subject;
            $time = 'time_' . $subject;
            $duration = 'duration_' . $subject;
            $credit_hours = 'credit_hours_' . $subject;
            $max_marks = 'max_marks_' . $subject;
            $min_marks = 'min_marks_' . $subject;
            if ($examsubject->count() > 0) {
                $examsubject = ExamSubject::find($examsubject[0]->id);
                $examsubject->date = $request->$date;
                $examsubject->time = $request->$time;
                $examsubject->duration = $request->$duration;
                $examsubject->max_marks = $request->$max_marks;
                $examsubject->min_marks = $request->$min_marks;
                $examsubject->credit_hours = $request->$credit_hours;
                $examsubject->save();
            } else {
                $new_subject = new ExamSubject();
                $new_subject->exam_group_item_id = $request->exam_group_item_id;
                $new_subject->subject_id = $subject;
                $new_subject->date = $request->$date;
                $new_subject->time = $request->$time;
                $new_subject->duration = $request->$duration;
                $new_subject->max_marks = $request->$max_marks;
                $new_subject->min_marks = $request->$min_marks;
                $new_subject->credit_hours = $request->$credit_hours;
                $new_subject->save();
            }
        }

        $this->remove_unchecked_subjects($request);
    }

    function remove_unchecked_subjects($request)
    {
        $all_exam_subjects = ExamSubject::where('exam_group_item_id', $request->exam_group_item_id)->get();
        foreach ($all_exam_subjects as $exsubject) {
            if (!in_array(Strval($exsubject->subject_id), $request->subjects)) {
                $s = ExamSubject::find($exsubject->id);
                $s->delete();
            }
        }
    }


    function add_students($request)
    {
        foreach ($request->students as $k => $student) {
            // check if subject exists already
            $examstudent = ExamStudent::where('exam_group_item_id', $request->exam_group_item_id)->where('student_id', $student)->get();
            if ($examstudent->count() == 0) {
                $new_student = new ExamStudent();
                $new_student->exam_group_item_id = $request->exam_group_item_id;
                $new_student->student_id = $student;
                $new_student->save();
            }
        }

        $this->remove_unchecked_students($request);
    }

    function remove_unchecked_students($request)
    {
        // check if removed some subejects
        $all_exam_students = ExamStudent::where('exam_group_item_id', $request->exam_group_item_id)->get();
        foreach ($all_exam_students as $exstudent) {
            if (!in_array(Strval($exstudent->student_id), $request->students)) {
                $s = ExamStudent::find($exstudent->id);
                $s->delete();
            }
        }
    }
}
