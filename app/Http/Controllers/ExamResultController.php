<?php

namespace App\Http\Controllers;

use App\Exports\ResultTemplate;
use App\Http\Controllers\Controller;
use App\Imports\ExamResultImport;
use App\Models\AcademicYear;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use App\Models\ExamGroup;
use App\Models\ExamGroupItem;
use App\Repositories\ClassRoomRepository;
use App\Repositories\ExamResultRepository;
use Maatwebsite\Excel\Facades\Excel;

class ExamResultController extends Controller
{

    public $classRoomRepository;
    public $examResultRepository;

    public function __construct(ClassRoomRepository $classRoomRepository, ExamResultRepository $examResultRepository)
    {
        $this->classRoomRepository = $classRoomRepository;
        $this->examResultRepository = $examResultRepository;
    }

    public function index(Request $request)
    {

        $list = true;
        $class_rooms = $this->classRoomRepository->active_classes();
        $exam_groups = ExamGroup::all();
        $exam_group_items = $this->examResultRepository->get_exam_items_json_v();
        $result = $this->examResultRepository->get_results($request);
        $theads = $result[0];
        $students = $result[1];
        $max_limit = $result[2];
        $type = $result[3];

        return view('exam_results.index', compact('exam_groups', 'exam_group_items', 'class_rooms', 'theads', 'students', 'max_limit', 'list','type'));
    }



    public function store_in_batch(Request $request)
    {
        $this->validate($request, ['exam_group_item_id' => 'required', 'students' => 'required', 'subject_id' => 'required']);
        $this->examResultRepository->store_in_batch($request);
        session()->flash('success', 'Records Created successfully.');
        return redirect()->back();
    }

    function import(Request $request)
    {
        $this->validate($request, ['file' => 'required']);
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        //Move Uploaded File
        $destinationPath = 'uploads';
        $file->move($destinationPath, $file->getClientOriginalName());
        Excel::import(new ExamResultImport, 'uploads/' . $filename);
        unlink('uploads/' . $filename);
        session()->flash('success', 'Content imported successfully');
        return redirect()->back();
    }

    function export(Request $request)
    {
        $this->validate($request, ['exam' => 'required', 'subject' => 'required']);
        $activeYear = AcademicYear::find($request->session()->get('ActiveYear'))->year;
        $exam_name = ExamGroupItem::find($request->exam)->name;
        $filename = 'Exam-' . $exam_name . '-Year-' . $activeYear . '-ResultTemplate.xlsx';
        return Excel::download(new ResultTemplate($request->subject, $activeYear, $request->exam), $filename);
    }

    function get_results(ExamGroupItem $examgroupitem, ClassRoom $classroom)
    {

        $subjects = $examgroupitem->exam_subjects;
        foreach ($subjects as $k => $subject) :
            $subject->subject = $subject->subject;
            $subjects[$k] = $subject;
        endforeach;

        $students = $examgroupitem->exam_students->map(function ($examstudent) use ($classroom, $examgroupitem) {
            if ($examstudent->student->hasClassRoom($classroom->id)) {
                $examstudent->student->exam_results =  $examstudent->student->exam_results->map(function ($result) use ($examgroupitem) {
                    $result->subject = $result->subject;
                    return $result->exam_group_item_id == $examgroupitem->id;
                });
                return  $examstudent->student;
            }
        });

        return response()->json(
            [$subjects, $students]
        )->header('Content-type', 'Application/json');
    }
}
