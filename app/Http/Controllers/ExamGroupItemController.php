<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamGroupItem;
use App\Models\ExamGroup;
use App\Models\Exam;
use App\Models\AcademicYear;
use App\Repositories\ExamGroupItemRepository;

class ExamGroupItemController extends Controller
{

    public $examGroupItemRepository;

    public function __construct(ExamGroupItemRepository $examGroupItemRepository)
    {
        $this->examGroupItemRepository = $examGroupItemRepository;
    }
    public function index()
    {
        $exam_group_items = ExamGroupItem::all();
        $list = true;
        return view('exam_group_items.index', compact('exam_group_items', 'list'));
    }
    public function create()
    {
        $exam_group_ids = ExamGroup::all();
        $exam_ids = Exam::all();
        $academic_year_ids = AcademicYear::all();
        return view('exam_group_items.create', compact('exam_group_ids', 'exam_ids', 'academic_year_ids'));
    }
    public function store(Request $request)
    {
        $this->validate($request, ['exam_group_id' => 'required', 'exam_id' => 'required', 'academic_year_id' => 'required',]);
        $examgroupitem = new ExamGroupItem();
        $examgroupitem->fill($request->all());
        $examgroupitem->save();
        return redirect()->route('exam_group_items.index');
    }
    public function show(ExamGroupItem $examgroupitem)
    {
        return view('exam_group_items.show', compact('examgroupitem',));
    }
    public function edit(ExamGroupItem $examgroupitem)
    {
        $exam_group_ids = ExamGroup::all();
        $exam_ids = Exam::all();
        $academic_year_ids = AcademicYear::all();
        return view('exam_group_items.edit', compact('examgroupitem', 'exam_group_ids', 'exam_ids', 'academic_year_ids'));
    }
    public function update(Request $request, ExamGroupItem  $examgroupitem)
    {
        $this->validate($request, ['exam_group_id' => 'required', 'exam_id' => 'required', 'academic_year_id' => 'required',]);
        $examgroupitem->exam_group_id = $request->exam_group_id;
        $examgroupitem->exam_id = $request->exam_id;
        $examgroupitem->academic_year_id = $request->academic_year_id;
        $examgroupitem->save();
        session()->flash('message', 'Record updated successfully.');
        return redirect()->route('exam_group_items.edit', $examgroupitem->id);
    }
    public function destroy(ExamGroupItem $examgroupitem)
    {
        $examgroupitem->delete();
        session()->flash('success', 'Deleted Successfully');
        return redirect()->back();
    }


    function add_subjects(Request $request)
    {
        $this->validate($request, ['subjects' => 'required', 'exam_group_item_id' => 'required']);
        $this->examGroupItemRepository->add_subjects($request);
        session()->flash('success', 'Subjects Added Successfully');
        return redirect()->back();
    }

    function add_students(Request $request)
    {
        $this->validate($request, ['students' => 'required', 'exam_group_item_id' => 'required']);
        $this->examGroupItemRepository->add_students($request);
        session()->flash('success', 'students Added Successfully');
        return redirect()->back();
    }
}
