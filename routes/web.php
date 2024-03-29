<?php

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttendanceResultController;
use App\Http\Controllers\AttendanceResultStatusController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookTypeController;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\ClassRoomSubjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamGroupController;
use App\Http\Controllers\ExamGroupItemController;
use App\Http\Controllers\ExamResultController;
use App\Http\Controllers\ExamTypeController;
use App\Http\Controllers\FeaturePermissionController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\FeeTypeController;
use App\Http\Controllers\Finance;
use App\Http\Controllers\GradingController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\HostelController;
use App\Http\Controllers\HostelRoomController;
use App\Http\Controllers\HostelRoomTypeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LibraryMemberController;
use App\Http\Controllers\LibraryMemberTypeController;
use App\Http\Controllers\PutBackController;
use App\Http\Controllers\RackController;
use App\Http\Controllers\RoleMenuController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\StudentClassRoomController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubjectGroupController;
use App\Http\Controllers\SubjectGroupItemController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherSubjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentAddressController;
use App\Http\Controllers\TakenBookController;
use App\Http\Controllers\TeacherAttendanceController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleRouteController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// not authorized route
Route::get('/not_authorized', function () {
    return view('not_authorized');
})->name('not_authorized');

// auth routes
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/verify_login', 'postLogin');
    Route::get('/logout', 'logout');
});

// Dashboard routes
Route::get('/', DashboardController::class . '@dashboard')->name('dashboard');


// User routes
Route::controller(UserController::class)->prefix('users')->name('users')->group(function () {
    Route::get('/', 'index')->name('.index');
    Route::get('/create', 'create')->name('.create');
    Route::get('/change_password', 'change_password')->name('.change_password');
    Route::post('/change_password', 'update_password')->name('.update_password');
    Route::post('/store', 'store')->name('.store');
    Route::get('/{user}', 'show')->name('.show');
    Route::get('/{user}/edit', 'edit')->name('.edit');
    Route::post('/{user}/update', 'update')->name('.update');
    Route::get('/{user}/delete', 'destroy')->name('.delete');
});

// Roles routes
Route::controller(RolesController::class)->prefix('roles')->name('roles')->group(function () {
    Route::get('/', 'index')->name('.index');
    Route::get('/create', 'create')->name('.create');
    Route::post('/store', 'store')->name('.store');
    Route::get('/{role}', 'show')->name('.show');
    Route::get('/{role}/edit', 'edit')->name('.edit');
    Route::post('/{role}/update', 'update')->name('.update');
    Route::get('/{role}/delete', 'destroy')->name('.delete');
});

// Role permissions routes
Route::controller(RoleMenuController::class)->prefix('role_menus')->name('role_menus')->group(function () {
    Route::get('/{role}', 'index')->name('.index');
    Route::post('/{role}/store', 'store')->name('.store');
});

Route::controller(AcademicYearController::class)->prefix("academic_years")->middleware("auth")->name("academic_years")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::post("/{academicyear}/update", "update")->name(".update");
    Route::get("/get_year_classes/{academicyear}", "get_year_classes")->name(".get_year_classes");
});
Route::controller(GuardianController::class)->prefix("guardians")->middleware("auth")->name("guardians")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{guardian}/edit", "edit")->name(".edit");
    Route::post("/{guardian}/update", "update")->name(".update");
    Route::get("/{guardian}/delete", "destroy")->name(".delete");
});
Route::controller(TeacherController::class)->prefix("teachers")->middleware("auth")->name("teachers")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{teacher}/edit", "edit")->name(".edit");
    Route::post("/{teacher}/update", "update")->name(".update");
    Route::get("/{teacher}/delete", "destroy")->name(".delete");
});
Route::controller(StudentController::class)->prefix("students")->middleware("auth")->name("students")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/search_students/{str}", "search_students")->name(".search_students");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{student}/edit", "edit")->name(".edit");
    Route::post("/{student}/update", "update")->name(".update");
    Route::get("/{student}/delete", "destroy")->name(".delete");
    Route::get("{student}/profile", "profile")->name(".profile");
    Route::post("/import", "import")->name(".import");
});

Route::controller(ClassRoomController::class)->prefix("class_rooms")->middleware("auth")->name("class_rooms")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{classroom}/edit", "edit")->name(".edit");
    Route::post("/{classroom}/update", "update")->name(".update");
    Route::get("/{classroom}/delete", "destroy")->name(".delete");
    Route::post("/import_students", "import_students")->name(".import_students");
    Route::get("/get_class_students/{classroom}", "get_class_students")->name(".get_class_students");
    Route::get("/students/{classroom}", "students")->name(".students");
});
Route::controller(ShiftController::class)->prefix("shifts")->middleware("auth")->name("shifts")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{shift}/edit", "edit")->name(".edit");
    Route::post("/{shift}/update", "update")->name(".update");
    Route::get("/{shift}/delete", "destroy")->name(".delete");
});

Route::controller(SubjectController::class)->prefix("subjects")->middleware("auth")->name("subjects")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{subject}/edit", "edit")->name(".edit");
    Route::post("/{subject}/update", "update")->name(".update");
    Route::get("/{subject}/delete", "destroy")->name(".delete");
});

Route::controller(SubjectGroupController::class)->prefix("subject_groups")->middleware("auth")->name("subject_groups")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{subjectgroup}/edit", "edit")->name(".edit");
    Route::post("/{subjectgroup}/update", "update")->name(".update");
    Route::get("/{subjectgroup}/delete", "destroy")->name(".delete");
});
Route::controller(SubjectGroupItemController::class)->prefix("subject_group_items")->middleware("auth")->name("subject_group_items")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{subjectgroupitem}/edit", "edit")->name(".edit");
    Route::post("/{subjectgroupitem}/update", "update")->name(".update");
    Route::get("/{subjectgroupitem}/delete", "destroy")->name(".delete");
});
Route::controller(ClassRoomSubjectController::class)->prefix("class_room_subjects")->middleware("auth")->name("class_room_subjects")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{classroomsubject}/edit", "edit")->name(".edit");
    Route::post("/{classroomsubject}/update", "update")->name(".update");
    Route::get("/{classroomsubject}/delete", "destroy")->name(".delete");
});
Route::controller(TeacherSubjectController::class)->prefix("teacher_subjects")->middleware("auth")->name("teacher_subjects")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{teachersubject}/edit", "edit")->name(".edit");
    Route::post("/{teachersubject}/update", "update")->name(".update");
    Route::get("/{teachersubject}/delete", "destroy")->name(".delete");
});
Route::controller(StudentClassRoomController::class)->prefix("student_class_rooms")->middleware("auth")->name("student_class_rooms")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::get("/admit_in_batches", "admit_in_batches")->name(".admit_in_batches");
    Route::post("/store", "store")->name(".store");
    Route::get("/{studentclassroom}/edit", "edit")->name(".edit");
    Route::post("/{studentclassroom}/update", "update")->name(".update");
    Route::get("/{studentclassroom}/delete", "destroy")->name(".delete");
});
Route::controller(ExamController::class)->prefix("exams")->middleware("auth")->name("exams")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{exam}/edit", "edit")->name(".edit");
    Route::post("/{exam}/update", "update")->name(".update");
    Route::get("/{exam}/delete", "destroy")->name(".delete");
    Route::get("/get_marks_sheet", "get_marks_sheet")->name(".get_marks_sheet");
    Route::post("/export_marks_sheet", "export_marks_sheet")->name(".export_marks_sheet");
    Route::get("/schedule", "schedule")->name(".schedule");
    Route::post("/schedule", "schedule")->name(".schedule");
});
Route::controller(ExamResultController::class)->prefix("exam_results")->middleware("auth")->name("exam_results")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::post("/", "index")->name(".index");
    Route::post("/store_in_batch", "store_in_batch")->name(".store_in_batch");
    Route::get("/{examresult}/delete", "destroy")->name(".delete");
    Route::post("/import_result_template", "import")->name(".import");
    Route::post("/export_result_template", "export")->name(".export");
    Route::get("/get_results/{examgroupitem}/{classroom}", "get_results")->name(".get_results");
});


Route::controller(FeeController::class)->prefix("fees")->middleware("auth")->name("fees")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{fee}/edit", "edit")->name(".edit");
    Route::post("/{fee}/update", "update")->name(".update");
    Route::get("/{fee}/delete", "destroy")->name(".delete");
    Route::get("/due_list", "due_list")->name(".due_list");
    Route::get("/paid_list", "paid_list")->name(".paid_list");
    Route::get("/search_due_fees/{classroom}", "search_due_fees")->name(".search_due_fees");
    Route::get("/search_paid_list/{classroom}", "search_paid_list")->name(".search_paid_list");
    Route::get("/collect_fees", "collect_fees")->name(".collect_fees");
    Route::post("/save_payments", "save_payments")->name(".save_payments");
    Route::post("/save_student_payment", "save_student_payment")->name(".save_student_payment");
    Route::get("/cancel_fee/{transaction_id}", "cancel_fee")->name(".cancel_fee");
});
Route::controller(FeeTypeController::class)->prefix("fee_types")->middleware("auth")->name("fee_types")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{feetype}/edit", "edit")->name(".edit");
    Route::post("/{feetype}/update", "update")->name(".update");
    Route::get("/{feetype}/delete", "destroy")->name(".delete");
});


Route::controller(Finance::class)->prefix("finance")->middleware("auth")->name("finance")->group(function () {
    Route::get('/', 'index')->name('.index');
    // finance routes
    Route::get('/new_account', 'new_account_form')->name(".accounts.create");
    Route::post('/update_account', 'update_account')->name(".accounts.edit");
    Route::post('/store_account', 'store_account')->name(".accounts.store");
    Route::get('/accounts', 'accounts')->name('.accounts');
    Route::get('/account_transactions/{id}', 'account_transactions')->name('.account_transactions');
    Route::get('/accounts/{id}/delete', function ($id) {
        DB::table('accounts')->where('id', $id)->delete();
        Session::flash('deleted', 'Account Deleted Successfully');
        return redirect('/accounts');
    });
    Route::post('/register_beginning_balance', 'register_beginning_balance')->name('.register_beginning_balance');
    Route::get('/journal_entry', 'journal_entry_form')->name('.journal.index');
    Route::post('/store_journal_entry', 'store_journal_entry')->name('.journal.store');
    Route::get('/balance_sheet', 'balance_sheet')->name('.balance_sheet.index');
    Route::get('/income_statement', 'income_statement')->name('.income_statement.index');
    Route::get('/trial_balance', 'trial_balance')->name('.trial_balance.index');
    Route::get('/expenses', 'expenses')->name('.expenses');
    Route::get('/new_expense', 'new_expense')->name('.new_expense');
    Route::post('/store_expense', 'store_expense')->name('.store_expense');
    Route::get('/new_expense_category', 'new_expense_category')->name('.new_expense_category');
    Route::post('/store_expense_category', 'store_expense_category')->name('.store_expense_category');
    Route::post('/pay_expense', 'pay_expense')->name('.expenses.pay');
    Route::get('/incomes', 'incomes')->name('.incomes');
    Route::get('/new_income', 'new_income')->name('.new_income');
    Route::post('/store_income', 'store_income')->name('.store_income');
    Route::get('/new_income_category', 'new_income_category')->name('.new_income_category');
    Route::post('/store_income_category', 'store_income_category')->name('.store_income_category');
    Route::post('/comfirm_income', 'comfirm_income')->name('.incomes.comfirm');
});

Route::controller(AttendanceController::class)->prefix("attendances")->middleware("auth")->name("attendances")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{attendance}/edit", "edit")->name(".edit");
    Route::post("/{attendance}/update", "update")->name(".update");
    Route::get("/{attendance}/delete", "destroy")->name(".delete");
});
Route::controller(AttendanceResultController::class)->prefix("attendance_results")->middleware("auth")->name("attendance_results")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::post("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{attendanceresult}/edit", "edit")->name(".edit");
    Route::post("/{attendanceresult}/update", "update")->name(".update");
    Route::get("/{attendanceresult}/delete", "destroy")->name(".delete");
});
Route::controller(AttendanceResultStatusController::class)->prefix("attendance_result_statuses")->middleware("auth")->name("attendance_result_statuses")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{attendanceresultstatus}/edit", "edit")->name(".edit");
    Route::post("/{attendanceresultstatus}/update", "update")->name(".update");
    Route::get("/{attendanceresultstatus}/delete", "destroy")->name(".delete");
});
Route::controller(LeaveController::class)->prefix("leaves")->middleware("auth")->name("leaves")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{leave}/edit", "edit")->name(".edit");
    Route::post("/{leave}/update", "update")->name(".update");
    Route::get("/{leave}/delete", "destroy")->name(".delete");
    Route::get("/{leave}/approve", "approve")->name(".approve");
});
Route::controller(ExamTypeController::class)->prefix("exam_types")->middleware("auth")->name("exam_types")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{examtype}/edit", "edit")->name(".edit");
    Route::post("/{examtype}/update", "update")->name(".update");
    Route::get("/{examtype}/delete", "destroy")->name(".delete");
});
Route::controller(ExamGroupController::class)->prefix("exam_groups")->middleware("auth")->name("exam_groups")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{examgroup}/edit", "edit")->name(".edit");
    Route::post("/{examgroup}/update", "update")->name(".update");
    Route::get("/{examgroup}/delete", "destroy")->name(".delete");
    Route::get("/{examgroup}/show", "show")->name(".show");
    Route::post("/{examgroup}/add_exam", "add_exam")->name(".add_exam");
});
Route::controller(ExamGroupItemController::class)->prefix("exam_group_items")->middleware("auth")->name("exam_group_items")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{examgroupitem}/edit", "edit")->name(".edit");
    Route::post("/{examgroupitem}/update", "update")->name(".update");
    Route::get("/{examgroupitem}/delete", "destroy")->name(".delete");
    Route::post("/add_subjects", "add_subjects")->name(".add_subjects");
    Route::post("/add_students", "add_students")->name(".add_students");
});
Route::controller(GradingController::class)->prefix("gradings")->middleware("auth")->name("gradings")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{grading}/edit", "edit")->name(".edit");
    Route::post("/{grading}/update", "update")->name(".update");
    Route::get("/{grading}/delete", "destroy")->name(".delete");
});
Route::controller(StudentAddressController::class)->prefix("student_addresses")->middleware("auth")->name("student_addresses")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{studentaddress}/edit", "edit")->name(".edit");
    Route::post("/{studentaddress}/update", "update")->name(".update");
    Route::get("/{studentaddress}/delete", "destroy")->name(".delete");
});
Route::controller(TeacherAttendanceController::class)->prefix("teacher_attendances")->middleware("auth")->name("teacher_attendances")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::post("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{teacherattendance}/edit", "edit")->name(".edit");
    Route::post("/{teacherattendance}/update", "update")->name(".update");
    Route::get("/{teacherattendance}/delete", "destroy")->name(".delete");
});
Route::controller(ScheduleController::class)->prefix("schedules")->middleware("auth")->name("schedules")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::post("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{schedule}/edit", "edit")->name(".edit");
    Route::post("/{schedule}/update", "update")->name(".update");
    Route::get("/{schedule}/delete", "destroy")->name(".delete");
});

Route::controller(FeaturePermissionController::class)->prefix("feature_permissions")->middleware("auth")->name("feature_permissions")->group(function () {
    Route::get('/{role}', 'index')->name('.index');
    Route::post('/{role}/store', 'store')->name('.store');
});

Route::controller(RackController::class)->prefix("racks")->middleware("auth")->name("racks")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{rack}/edit", "edit")->name(".edit");
    Route::post("/{rack}/update", "update")->name(".update");
    Route::get("/{rack}/delete", "destroy")->name(".delete");
});
Route::controller(BookCategoryController::class)->prefix("book_categories")->middleware("auth")->name("book_categories")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{bookcategory}/edit", "edit")->name(".edit");
    Route::post("/{bookcategory}/update", "update")->name(".update");
    Route::get("/{bookcategory}/delete", "destroy")->name(".delete");
});
Route::controller(BookTypeController::class)->prefix("book_types")->middleware("auth")->name("book_types")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{booktype}/edit", "edit")->name(".edit");
    Route::post("/{booktype}/update", "update")->name(".update");
    Route::get("/{booktype}/delete", "destroy")->name(".delete");
});
Route::controller(LibraryMemberTypeController::class)->prefix("library_member_types")->middleware("auth")->name("library_member_types")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{librarymembertype}/edit", "edit")->name(".edit");
    Route::post("/{librarymembertype}/update", "update")->name(".update");
    Route::get("/{librarymembertype}/delete", "destroy")->name(".delete");
});
Route::controller(LibraryMemberController::class)->prefix("library_members")->middleware("auth")->name("library_members")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{librarymember}/edit", "edit")->name(".edit");
    Route::post("/{librarymember}/update", "update")->name(".update");
    Route::get("/{librarymember}/delete", "destroy")->name(".delete");
});
Route::controller(BookController::class)->prefix("books")->middleware("auth")->name("books")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{book}/edit", "edit")->name(".edit");
    Route::post("/{book}/update", "update")->name(".update");
    Route::get("/{book}/delete", "destroy")->name(".delete");
});
Route::controller(TakenBookController::class)->prefix("taken_books")->middleware("auth")->name("taken_books")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{takenbook}/edit", "edit")->name(".edit");
    Route::post("/{takenbook}/update", "update")->name(".update");
    Route::get("/{takenbook}/delete", "destroy")->name(".delete");
});
Route::controller(PutBackController::class)->prefix("putbacks")->middleware("auth")->name("putbacks")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{putback}/edit", "edit")->name(".edit");
    Route::post("/{putback}/update", "update")->name(".update");
    Route::get("/{putback}/delete", "destroy")->name(".delete");
});
Route::controller(HostelController::class)->prefix("hostels")->middleware("auth")->name("hostels")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{hostel}/edit", "edit")->name(".edit");
    Route::post("/{hostel}/update", "update")->name(".update");
    Route::get("/{hostel}/delete", "destroy")->name(".delete");
});
Route::controller(HostelRoomTypeController::class)->prefix("hostel_room_types")->middleware("auth")->name("hostel_room_types")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{hostelroomtype}/edit", "edit")->name(".edit");
    Route::post("/{hostelroomtype}/update", "update")->name(".update");
    Route::get("/{hostelroomtype}/delete", "destroy")->name(".delete");
});
Route::controller(HostelRoomController::class)->prefix("hostel_rooms")->middleware("auth")->name("hostel_rooms")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{hostelroom}/edit", "edit")->name(".edit");
    Route::post("/{hostelroom}/update", "update")->name(".update");
    Route::get("/{hostelroom}/delete", "destroy")->name(".delete");
});
Route::controller(RouteController::class)->prefix("routes")->middleware("auth")->name("routes")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{route}/edit", "edit")->name(".edit");
    Route::post("/{route}/update", "update")->name(".update");
    Route::get("/{route}/delete", "destroy")->name(".delete");
});
Route::controller(VehicleController::class)->prefix("vehicles")->middleware("auth")->name("vehicles")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{vehicle}/edit", "edit")->name(".edit");
    Route::post("/{vehicle}/update", "update")->name(".update");
    Route::get("/{vehicle}/delete", "destroy")->name(".delete");
});
Route::controller(VehicleRouteController::class)->prefix("vehicle_routes")->middleware("auth")->name("vehicle_routes")->group(function () {
    Route::get("/", "index")->name(".index");
    Route::get("/create", "create")->name(".create");
    Route::post("/store", "store")->name(".store");
    Route::get("/{vehicleroute}/edit", "edit")->name(".edit");
    Route::post("/{vehicleroute}/update", "update")->name(".update");
    Route::get("/{vehicleroute}/delete", "destroy")->name(".delete");
});