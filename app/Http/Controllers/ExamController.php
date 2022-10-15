<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\ExamGroup;
use App\Models\ExamGroupItem;
use App\Repositories\ClassRoomRepository;
use App\Repositories\ExamRepository;
use App\Services\CheckActiveYear;

class ExamController extends Controller
{

    protected $examRepository;
    protected $classRoomRepository;


    public function __construct(ClassRoomRepository $classRoomRepository, ExamRepository $examRepository)
    {
        $this->classRoomRepository = $classRoomRepository;
        $this->examRepository = $examRepository;
    }

    public function index()
    {
        $exams = Exam::all();
        $list = true;
        return view('exams.index', compact('exams', 'list'));
    }
    public function create()
    {
        return view('exams.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required',]);

        $exam = new Exam();
        $exam->fill($request->all());
        $exam->save();

        if (isset($request->exam_group_id)) {
            $activeYear = CheckActiveYear::check_active_year();

            $group_item = new ExamGroupItem();
            $group_item->academic_year_id = $activeYear;
            $group_item->exam_id = $exam->id;
            $group_item->exam_group_id = $request->exam_group_id;
            $group_item->save();
            session()->flash('success', 'Exam Added Successfully');
            return redirect()->route('exam_groups.show', $request->exam_group_id);
        }

        session()->flash('success', 'Record created successfully.');
        return redirect()->route('exams.index');
    }
    public function show(Exam $exam)
    {
        return view('exams.show', compact(' exam',));
    }
    public function edit(Exam $exam)
    {
        return view('exams.edit', compact('exam'));
    }

    public function update(Request $request, Exam  $exam)
    {
        $this->validate($request, ['name' => 'required',]);
        $exam->name = $request->name;
        $exam->save();
        session()->flash('success', 'Record updated successfully.');
        return redirect()->route('exams.edit', $exam->id);
    }

    public function destroy(Exam $exam)
    {
        $exam->delete();
        return redirect()->route('exams.index');
        session()->flash('success', 'Deleted Successfully');
    }

    function schedule(Request $request)
    {

        $list = true;
        $exam_groups = ExamGroup::all();
        $exam_group_items = ExamGroupItem::all();
        foreach ($exam_group_items as $k => $item) :
            $item->exam = $item->exam;
            $exam_group_items[$k] = $item;
        endforeach;

        $examgrouptitem =  false;
        if ($request->getMethod() == 'POST') :
            $examgrouptitem = ExamGroupItem::find($request->exam_group_item_id);
        endif;

        return view('exams.exam_schedule', compact('examgrouptitem','list','exam_groups','exam_group_items'));
    }
}
