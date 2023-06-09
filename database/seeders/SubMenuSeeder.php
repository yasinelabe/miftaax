<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('sub_menus')->insert([
            [
                'name' => 'Academic Year',
                'link' => '/academic_years',
                'has_low_menu' => 0,
                'menu_id' => 2
            ],
            [
                'name' => 'Class Rooms',
                'link' => '/class_rooms',
                'has_low_menu' => 0,
                'menu_id' => 2
            ],
            [
                'name' => 'Shifts',
                'link' => '/shifts',
                'has_low_menu' => 0,
                'menu_id' => 2
            ],
            [
                'name' => 'Subjects',
                'link' => '/subjects',
                'has_low_menu' => 0,
                'menu_id' => 2
            ],
            [
                'name' => 'Teachers',
                'link' => '/teachers',
                'has_low_menu' => 0,
                'menu_id' => 2
            ],
            [
                'name' => 'Subject Groups',
                'link' => '/subject_groups',
                'has_low_menu' => 0,
                'menu_id' => 2
            ],
            [
                'name' => 'Teacher Subject Mapping',
                'link' => '/teacher_subjects',
                'has_low_menu' => 0,
                'menu_id' => 2
            ],
            [
                'name' => 'Class Subject Mapping',
                'link' => '/class_room_subjects',
                'has_low_menu' => 0,
                'menu_id' => 2
            ],
            [
                'name' => 'Time Table',
                'link' => '/schedules',
                'has_low_menu' => 0,
                'menu_id' => 2
            ],
            [
                'name' => 'Grading',
                'link' => '/gradings',
                'has_low_menu' => 0,
                'menu_id' => 3
            ],
            [
                'name' => 'Exam Groups',
                'link' => '/exam_groups',
                'has_low_menu' => 0,
                'menu_id' => 3
            ],
            [
                'name' => 'Exams',
                'link' => '/exams',
                'has_low_menu' => 0,
                'menu_id' => 3
            ],
            [
                'name' => 'Exam Results',
                'link' => '/exam_results',
                'has_low_menu' => 0,
                'menu_id' => 3
            ],
            [
                'name' => 'Exam Schedule',
                'link' => '/exams/schedule',
                'has_low_menu' => 0,
                'menu_id' => 3
            ],
            [
                'name' => 'Fees List',
                'link' => '/fees',
                'has_low_menu' => 0,
                'menu_id' => 4
            ],
            [
                'name' => 'Generate Fee',
                'link' => '/fees/create',
                'has_low_menu' => 0,
                'menu_id' => 4
            ],
            [
                'name' => 'Collect Fees',
                'link' => '/fees/collect_fees',
                'has_low_menu' => 0,
                'menu_id' => 4
            ],
            [
                'name' => 'Search Due List',
                'link' => '/fees/due_list',
                'has_low_menu' => 0,
                'menu_id' => 4
            ],
            [
                'name' => 'Search Paid Fees',
                'link' => '/fees/paid_list',
                'has_low_menu' => 0,
                'menu_id' => 4
            ],
            [
                'name' => 'Fee Types',
                'link' => '/fee_types',
                'has_low_menu' => 0,
                'menu_id' => 4
            ],
            [
                'name' => 'Make Attendance',
                'link' => '/attendances',
                'has_low_menu' => 0,
                'menu_id' => 5
            ],
            [
                'name' => 'Attendance Status',
                'link' => '/attendance_result_statuses',
                'has_low_menu' => 0,
                'menu_id' => 5
            ],
            [
                'name' => 'Leaves',
                'link' => '/leaves',
                'has_low_menu' => 0,
                'menu_id' => 5
            ],
            [
                'name' => 'Teacher Attendance',
                'link' => '/teacher_attendances',
                'has_low_menu' => 0,
                'menu_id' => 5
            ],
            [
                'name' => 'Student Attendance Report',
                'link' => '/attendance_results',
                'has_low_menu' => 0,
                'menu_id' => 5
            ],
            [
                'name' => 'Chart of accounts',
                'link' => '/finance/accounts',
                'has_low_menu' => 0,
                'menu_id' => 6
            ],
            [
                'name' => 'Journal Entry',
                'link' => '/finance/journal_entry',
                'has_low_menu' => 0,
                'menu_id' => 6
            ],
            [
                'name' => 'Balance Sheet',
                'link' => '/finance/balance_sheet',
                'has_low_menu' => 0,
                'menu_id' => 6
            ],
            [
                'name' => 'Trial Balance',
                'link' => '/finance/trial_balance',
                'has_low_menu' => 0,
                'menu_id' => 6
            ],
            [
                'name' => 'Income Statement',
                'link' => '/finance/income_statement',
                'has_low_menu' => 0,
                'menu_id' => 6
            ],
            [
                'name' => 'Expenses',
                'link' => '/finance/expenses',
                'has_low_menu' => 0,
                'menu_id' => 6
            ],
            [
                'name' => 'New Expense',
                'link' => '/finance/new_expense',
                'has_low_menu' => 0,
                'menu_id' => 6
            ],
            [
                'name' => 'New Expense Head',
                'link' => '/finance/new_expense_category',
                'has_low_menu' => 0,
                'menu_id' => 6
            ],
            [
                'name' => 'Student Details',
                'link' => '/students',
                'has_low_menu' => 0,
                'menu_id' => 7
            ],
            [
                'name' => 'Student Admission',
                'link' => '',
                'has_low_menu' => 1,
                'menu_id' => 7
            ],
            [
                'name' => 'Graduated Students',
                'link' => '#',
                'has_low_menu' => 0,
                'menu_id' => 7
            ],
            [
                'name' => 'Student Addresses',
                'link' => '/student_addresses',
                'has_low_menu' => 0,
                'menu_id' => 7
            ],
            [
                'name' => 'Parents / Guardians',
                'link' => '/guardians',
                'has_low_menu' => 0,
                'menu_id' => 7
            ],
            [
                'name' => 'Users',
                'link' => '/users',
                'has_low_menu' => 0,
                'menu_id' => 8
            ],
            [
                'name' => 'Roles',
                'link' => '/roles',
                'has_low_menu' => 0,
                'menu_id' => 8
            ],
            [
                'name' => 'Racks',
                'link' => '/racks',
                'has_low_menu' => 0,
                'menu_id' => 9
            ],
            [
                'name' => 'Books',
                'link' => '/books',
                'has_low_menu' => 0,
                'menu_id' => 9
            ],
            [
                'name' => 'Book types',
                'link' => '/book_types',
                'has_low_menu' => 0,
                'menu_id' => 9
            ],
            [
                'name' => 'Book categories',
                'link' => '/book_categories',
                'has_low_menu' => 0,
                'menu_id' => 9
            ],
            [
                'name' => 'Taken books',
                'link' => '/taken_books',
                'has_low_menu' => 0,
                'menu_id' => 9
            ],
            [
                'name' => 'Issue Book',
                'link' => '/taken_books/create',
                'has_low_menu' => 0,
                'menu_id' => 9
            ],
            [
                'name' => 'Book returns',
                'link' => '/putbacks',
                'has_low_menu' => 0,
                'menu_id' => 9
            ],
            [
                'name' => 'Library members',
                'link' => '/library_members',
                'has_low_menu' => 0,
                'menu_id' => 9
            ],
            [
                'name' => 'Library member types',
                'link' => '/library_member_types',
                'has_low_menu' => 0,
                'menu_id' => 9
            ],
            [
                'name' => 'Vehicles',
                'link' => '/vehicles',
                'has_low_menu' => 0,
                'menu_id' => 10
            ],
            [
                'name' => 'Routes',
                'link' => '/routes',
                'has_low_menu' => 0,
                'menu_id' => 10
            ],
            [
                'name' => 'Vehicle Route Mapping',
                'link' => '/vehicle_routes',
                'has_low_menu' => 0,
                'menu_id' => 10
            ],
            [
                'name' => 'Hostels',
                'link' => '/hostels',
                'has_low_menu' => 0,
                'menu_id' => 11
            ],
            [
                'name' => 'Hostel Rooms',
                'link' => '/hostel_rooms',
                'has_low_menu' => 0,
                'menu_id' => 11
            ],
            [
                'name' => 'Hostel Room Types',
                'link' => '/hostel_room_types',
                'has_low_menu' => 0,
                'menu_id' => 11
            ],
        ]);
    }
}
