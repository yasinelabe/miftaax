<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;
use App\Models\ExamGroup;
use App\Models\ExamGroupItem;
use App\Models\ExamType;
use App\Models\Subject;
use App\Repositories\ClassRoomRepository;
use App\Services\CheckActiveYear;

class ExamGroupController extends Controller
{

    protected $classRoomRepository;

    public function __construct(ClassRoomRepository $classRoomRepository)
    {
        $this->classRoomRepository = $classRoomRepository;
    }
    public function index()
    {
        $exam_groups = ExamGroup::all();
        $list = true;
        return view('exam_groups.index', compact('exam_groups', 'list'));
    }
    public function create()
    {
        $exam_type_ids = ExamType::all();
        return view('exam_groups.create', compact('exam_type_ids'));
    }
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required', 'description' => 'required', 'exam_type_id' => 'required',]);
        $examgroup = new ExamGroup();
        $examgroup->fill($request->all());
        $examgroup->save();
        return redirect()->route('exam_groups.index');
    }
    public function show(ExamGroup $examgroup)
    {
        $subjects = Subject::all();
        $activeYear = Session()->get('ActiveYear');
        $exams = Exam::all();
        $class_rooms = $this->classRoomRepository->active_classes();
        return view('exam_groups.show', compact('examgroup', 'subjects', 'activeYear', 'exams','class_rooms'));
    }
    public function edit(ExamGroup $examgroup)
    {
        $exam_type_ids = ExamType::all();
        return view('exam_groups.edit', compact('examgroup', 'exam_type_ids'));
    }
    public function update(Request $request, ExamGroup  $examgroup)
    {
        $this->validate($request, ['name' => 'required', 'description' => 'required', 'exam_type_id' => 'required',]);
        $examgroup->name = $request->name;
        $examgroup->description = $request->description;
        $examgroup->exam_type_id = $request->exam_type_id;
        $examgroup->save();
        session()->flash('message', 'Record updated successfully.');
        return redirect()->route('exam_groups.edit', $examgroup->id);
    }
    public function destroy(ExamGroup $examgroup)
    {
        $examgroup->delete();
        session()->flash('success', 'Deleted Successfully');
        return redirect()->route('exam_groups.index');
    }


    function add_exam(Request $request, ExamGroup  $examgroup)
    {
        $activeYear =  CheckActiveYear::check_active_year();
        foreach ($request->exams as $exam) :
            // check if exists
            $gitem = ExamGroupItem::where('exam_group_id', $examgroup->id)->where('exam_id', $exam)->get();
            if (!$gitem->count() > 0) {
                $group_item = new ExamGroupItem();
                $group_item->academic_year_id = $activeYear;
                $group_item->exam_id = $exam;
                $group_item->exam_group_id = $examgroup->id;
                $group_item->save();
            }
        endforeach;
        session()->flash('success', 'Exam Added Successfully');
        return redirect()->back();
    }
}
