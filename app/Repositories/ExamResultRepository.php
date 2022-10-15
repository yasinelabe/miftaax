<?php

namespace App\Repositories;

use App\Models\ClassRoom;
use App\Models\ExamGroupItem;
use App\Models\ExamResult;
use App\Models\ExamSubject;
use App\Models\Grading;

class ExamResultRepository
{

    public function store_in_batch($request)
    {
        $subject = ExamSubject::where(['subject_id' => $request->subject_id, 'exam_group_item_id' => $request->exam_group_item_id])->get();
        $min_marks = isset($subject[0]) ? $subject[0]->min_marks : 'x';
        $max_marks = isset($subject[0]) ? $subject[0]->max_marks : 'x';
        $min_marks = isset($subject[0]) ? $subject[0]->min_marks : 'x';
        $max_marks = isset($subject[0]) ? $subject[0]->max_marks : 'x';

        if ($min_marks == 'x' || $max_marks == '') {
            return   redirect()->back()->with('error', 'Invalid Subject');
        }

        foreach ($request->students as $student) :
            $marks = 'marks_' . $student;
            $request->$marks = number_format((float)$request->$marks, 2, '.', '');
            $note = 'note_' . $student;
            $is_absent = 'is_absent' . $student;
            $grading_id = isset($request->$is_absent)  ? Grading::get_grading_id(0, $max_marks) : Grading::get_grading_id((int)$request->$marks, $max_marks);
            $old_result = ExamResult::where(['exam_group_item_id' => $request->exam_group_item_id, 'student_id' => $student, 'subject_id' => $request->subject_id])->get();
            if ($request->$marks < $min_marks || isset($request->$is_absent)) {
                $status = 0;
            } else {
                $status = 1;
            }

            if ($old_result->count() > 0) {
                $old_resul = ExamResult::find($old_result[0]->id);
                $old_resul->marks =  isset($request->$is_absent)  ? 0 : $request->$marks;
                $old_resul->note =  isset($request->$is_absent)  ? 'Fail' : $request->$note;
                $old_resul->grading_id = $grading_id;
                $old_resul->is_absent = isset($request->$is_absent) ? 1 : 0;
                $old_resul->status = $status;
                $old_resul->save();
            } else {
                $examresult = new ExamResult();
                $examresult->exam_group_item_id = $request->exam_group_item_id;
                $examresult->student_id = $student;
                $examresult->subject_id = $request->subject_id;
                $examresult->marks =  isset($request->$is_absent)  ? 0 : $request->$marks;
                $examresult->note =  isset($request->$is_absent)  ? 'Fail' : $request->$note;
                $examresult->grading_id = $grading_id;
                $examresult->is_absent = isset($request->$is_absent) ? 1 : 0;
                $examresult->status = $status;
                $examresult->save();
            }
        endforeach;
    }

    function get_results($request): array
    {
        $theads = [];
        $students = [];
        $max_limit = 0;
        $type = '';

        if ($request->getMethod() == 'POST') :

            $examgroupitem = ExamGroupItem::find($request->exam_group_item_id);
            $classroom = ClassRoom::find($request->class_room_id);

            if ($examgroupitem->exam_group->exam_type->id == 3) {
                $type = 'GPA';
                $theads = [0 => [0, 'StudentID'], 1 => [1, 'Student Name']];

                $subjects = $examgroupitem->exam_subjects;
                foreach ($subjects as $k => $subject) :
                    $subj = [$subject->subject->id, $subject->subject->name . '(' . $subject->min_marks . '/' . $subject->max_marks . ')'.'( Grade ) * ( Credit Hours ) = ( Points )'];
                    array_push($theads, $subj);
                    $max_limit += (float)$subject->max_marks;
                endforeach;

                end($theads);
                $last_key = key($theads);
                array_push($theads, [$last_key + 1, 'Grade']);

                $students = $examgroupitem->exam_students->map(function ($examstudent) use ($classroom, $examgroupitem) {
                    if ($examstudent->student->hasClassRoom($classroom->id)) {
                        $examstudent->student->exam_results =  $examstudent->student->exam_results->map(function ($result) use ($examgroupitem) {
                            $result->subject = $result->subject;
                            if ($result->exam_group_item_id == $examgroupitem->id) {
                                return $result;
                            }
                        });
                        return  $examstudent->student;
                    }
                });
                return [];
            } else {
                $type = 'Normal';
                $theads = [0 => [0, 'StudentID'], 1 => [1, 'Student Name']];

                $subjects = $examgroupitem->exam_subjects;
                foreach ($subjects as $k => $subject) :
                    $subj = [$subject->subject->id, $subject->subject->name . '(' . $subject->min_marks . '/' . $subject->max_marks . ')'];
                    array_push($theads, $subj);
                    $max_limit += (float)$subject->max_marks;
                endforeach;

                end($theads);
                $last_key = key($theads);
                array_push($theads, [$last_key + 1, 'GrandTotal']);
                array_push($theads, [$last_key + 2, 'Percent']);
                array_push($theads, [$last_key + 3, 'Grade']);

                $students = $examgroupitem->exam_students->map(function ($examstudent) use ($classroom, $examgroupitem) {
                    if ($examstudent->student->hasClassRoom($classroom->id)) {
                        $examstudent->student->exam_results =  $examstudent->student->exam_results->map(function ($result) use ($examgroupitem) {
                            $result->subject = $result->subject;
                            if ($result->exam_group_item_id == $examgroupitem->id) {
                                return $result;
                            }
                        });
                        return  $examstudent->student;
                    }
                });
            }


        endif;

        return [$theads, $students, $max_limit,$type];
    }

    function get_exam_items_json_v()
    {
        $all = ExamGroupItem::all();
        foreach ($all as $k => $item) :
            $item->exam = $item->exam;
            $exam_group_items[$k] = $item;
        endforeach;
        return $all;
    }
}
