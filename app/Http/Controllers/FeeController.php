<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use App\Models\Fee;
use App\Models\FeeType;
use App\Repositories\ClassRoomRepository;
use App\Repositories\FeeRepository;
use App\Services\CheckActiveYear;

class FeeController extends Controller
{

    protected $feeRepository;
    protected $classRoomRepository;


    public function __construct(FeeRepository $feeRepository, ClassRoomRepository $classRoomRepository)
    {
        $this->feeRepository = $feeRepository;
        $this->classRoomRepository = $classRoomRepository;
    }

    public function index()
    {
        $fees = $this->feeRepository->active_fees();
        $list = true;
        return view('fees.index', compact('fees', 'list'));
    }

    public function create()
    {
        $fee_type_ids = FeeType::all();;
        return view('fees.create', compact('fee_type_ids'));
    }

    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required', 'month' => 'required', 'fee_type_id' => 'required',]);
        $activeYear =  CheckActiveYear::check_active_year();

        $fee = new Fee();
        $fee->fill($request->all());
        $fee->academic_year_id = $activeYear;
        $fee->save();

        $active_classes = $this->classRoomRepository->active_classes();
        foreach ($active_classes as $active_class) {
            $class_students = $active_class->students;
            foreach ($class_students as $student) :
                $this->feeRepository->generate_student_fee($student, $fee, $request->name);
            endforeach;
        }

        return redirect()->route('fees.index');
    }
    public function show(Fee $fee)
    {
        return view('fees.show', compact(' fee',));
    }
    public function edit(Fee $fee)
    {
        $fee_type_ids = FeeType::all();
        return view('fees.edit', compact('fee', 'fee_type_ids'));
    }
    public function update(Request $request, Fee  $fee)
    {
        $this->validate($request, ['name' => 'required', 'month' => 'required', 'fee_type_id' => 'required',]);
        $fee->name = $request->name;
        $fee->month = $request->month;
        $fee->fee_type_id = $request->fee_type_id;
        $fee->save();
        session()->flash('success', 'Record updated successfully.');
        return redirect()->route('fees.edit', $fee->id);
    }
    public function destroy(Fee $fee)
    {
        $fee->delete();
        session()->flash('success', 'Deleted Successfully');
        return redirect()->route('fees.index');
    }

    public function collect_fees()
    {
        $class_rooms = $this->classRoomRepository->active_classes();
        $fees = $this->feeRepository->active_fees();
        $list = true;
        $cash_accounts = Account::whereIn('parent_id',  [1, 2, 3])->orwhereIn('id', [1, 2, 3])->get();
        return view('fees.collect_fees', compact('class_rooms', 'fees', 'cash_accounts', 'list'));
    }

    public function save_payments(Request $request)
    {
        $this->validate($request, ['students' => 'required',  'paid_amounts' => 'required', 'receiving_account_id' => 'required']);
        foreach ($request->students as $k => $student) :
            $paid_amount = $request->paid_amounts[$k];
            $receiving_account = Account::find($request->receiving_account_id);
            $this->feeRepository->save_student_payment($student, $paid_amount, $request->fee_id, $receiving_account);
        endforeach;
        session()->flash('success', 'Fees collection saved');
        return redirect()->route('fees.collect_fees');
    }

    public function save_student_payment(Request $request)
    {
        $this->validate($request, ['student_id' => 'required',  'amount' => 'required', 'receiving_account_id' => 'required']);
        $paid_amount = $request->amount;
        $student = $request->student_id;
        $receiving_account = Account::find($request->receiving_account_id);
        $this->feeRepository->save_student_payment($student, $paid_amount, $request->fee_id, $receiving_account);
        session()->flash('success', 'Fees collection saved');
        return redirect()->route('fees.collect_fees');
    }

    public function due_list()
    {
        $class_rooms = $this->classRoomRepository->active_classes();
        $list = true;
        return view('fees.due_list', compact('class_rooms', 'list'));
    }

    public function search_due_fees(ClassRoom $classroom)
    {
        $students = $classroom->students;
        $unpaid_students = [];
        foreach ($students as $student) {
            if ($student->fee_balance > 0) {
                array_push($unpaid_students, $student);
            }
        }
        return response()->json(
            $unpaid_students
        );
    }
}
