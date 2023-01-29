<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('features')->insert([
            [
                'feature_name' => 'View Dashboard',
                'created_at' => now(),
                'route_name' => 'dashboard',
            ],
            [
                'feature_name' => 'View Users',
                'created_at' => now(),
                'route_name' => 'users.index',
            ],
            [
                'feature_name' => 'Create Users',
                'created_at' => now(),
                'route_name' => 'users.create,users.store',
            ],
            [
                'feature_name' => 'Change Password',
                'created_at' => now(),
                'route_name' => 'users.change_password,users.update_password',
            ],
            [
                'feature_name' => 'User profile',
                'created_at' => now(),
                'route_name' => 'users.show',
            ],
            [
                'feature_name' => 'Edit Users',
                'created_at' => now(),
                'route_name' => 'users.edit,users.update',
            ],
            [
                'feature_name' => 'Delete Users',
                'created_at' => now(),
                'route_name' => 'users.delete',
            ],
            [
                'feature_name' => 'View Roles',
                'created_at' => now(),
                'route_name' => 'roles.index',
            ],
            [
                'feature_name' => 'Create Roles',
                'created_at' => now(),
                'route_name' => 'roles.create,roles.store',
            ],
            [
                'feature_name' => 'View Role',
                'created_at' => now(),
                'route_name' => 'roles.show',
            ],
            [
                'feature_name' => 'Edit Roles',
                'created_at' => now(),
                'route_name' => 'roles.edit,roles.update',
            ],
            [
                'feature_name' => 'Delete Roles',
                'created_at' => now(),
                'route_name' => 'roles.delete',
            ],
            [
                'feature_name' => 'View Role Menus',
                'created_at' => now(),
                'route_name' => 'role_menus.index',
            ],
            [
                'feature_name' => 'Update Role Menus',
                'created_at' => now(),
                'route_name' => 'role_menus.store',
            ],
            [
                'feature_name' => 'View Academic Years',
                'created_at' => now(),
                'route_name' => 'academic_years.index',
            ],
            [
                'feature_name' => 'Create Academic Years',
                'created_at' => now(),
                'route_name' => 'academic_years.create,academic_years.store',
            ],
            [
                'feature_name' => 'Edit Academic Years',
                'created_at' => now(),
                'route_name' => 'academic_years.edit,academic_years.update',
            ],
            [
                'feature_name' => 'Read Academic Year Classes',
                'created_at' => now(),
                'route_name' => 'academic_years.get_year_classes',
            ],
         
            [
                'feature_name' => 'View Guardians',
                'created_at' => now(),
                'route_name' => 'guardians.index',
            ],
            [
                'feature_name' => 'Create Guardians',
                'created_at' => now(),
                'route_name' => 'guardians.create,guardians.store',
            ],
            [
                'feature_name' => 'Edit Guardians',
                'created_at' => now(),
                'route_name' => 'guardians.edit,guardians.update',
            ],
            [
                'feature_name' => 'Delete Guardians',
                'created_at' => now(),
                'route_name' => 'guardians.delete',
            ],
            
            [
                'feature_name' => 'View Teachers',
                'created_at' => now(),
                'route_name' => 'teachers.index',
            ],
            [
                'feature_name' => 'Create Teachers',
                'created_at' => now(),
                'route_name' => 'teachers.create,teachers.store',
            ],
            [
                'feature_name' => 'Edit Teachers',
                'created_at' => now(),
                'route_name' => 'teachers.edit,teachers.update',
            ],
            [
                'feature_name' => 'Delete Teachers',
                'created_at' => now(),
                'route_name' => 'teachers.delete',
            ],
            [
                'feature_name' => 'View Students',
                'created_at' => now(),
                'route_name' => 'students.index',
            ],
            [
                'feature_name' => 'Create Students',
                'created_at' => now(),
                'route_name' => 'students.create,students.store',
            ],
            [
                'feature_name' => 'Edit Students',
                'created_at' => now(),
                'route_name' => 'students.edit,students.update',
            ],
            [
                'feature_name' => 'Delete Students',
                'created_at' => now(),
                'route_name' => 'students.delete',
            ],
            [
                'feature_name' => 'Search Students',
                'created_at' => now(),
                'route_name' => 'students.search_students',
            ],
            [
                'feature_name' => 'Student Profile',
                'created_at' => now(),
                'route_name' => 'students.profile',
            ],
            [
                'feature_name' => 'Import Students',
                'created_at' => now(),
                'route_name' => 'students.import',
            ],
            
        
            [
                'feature_name' => 'View Class Rooms',
                'created_at' => now(),
                'route_name' => 'class_rooms.index',
            ],
            [
                'feature_name' => 'Create Class Rooms',
                'created_at' => now(),
                'route_name' => 'class_rooms.create,class_rooms.store',
            ],
            [
                'feature_name' => 'Edit Class Rooms',
                'created_at' => now(),
                'route_name' => 'class_rooms.edit,class_rooms.update',
            ],
            [
                'feature_name' => 'Delete Class Rooms',
                'created_at' => now(),
                'route_name' => 'class_rooms.delete',
            ],
            [
                'feature_name' => 'Promote Students',
                'created_at' => now(),
                'route_name' => 'class_rooms.import_students',
            ],
            [
                'feature_name' => 'View Class Room Students',
                'created_at' => now(),
                'route_name' => 'class_rooms.get_class_students,class_room.students',
            ],
            [
                'feature_name' => 'View Shifts',
                'created_at' => now(),
                'route_name' => 'shifts.index',
            ],
            [
                'feature_name' => 'Create Shifts',
                'created_at' => now(),
                'route_name' => 'shifts.create,shifts.store',
            ],
            [
                'feature_name' => 'Edit Shifts',
                'created_at' => now(),
                'route_name' => 'shifts.edit,shifts.update',
            ],
            [
                'feature_name' => 'Delete Shifts',
                'created_at' => now(),
                'route_name' => 'shifts.delete',
            ],
            [
                'feature_name' => 'View Subjects',
                'created_at' => now(),
                'route_name' => 'subjects.index',
            ],
            [
                'feature_name' => 'Create Subjects',
                'created_at' => now(),
                'route_name' => 'subjects.create,subjects.store',
            ],
            [
                'feature_name' => 'Edit Subjects',
                'created_at' => now(),
                'route_name' => 'subjects.edit,subjects.update',
            ],
            [
                'feature_name' => 'Delete Subjects',
                'created_at' => now(),
                'route_name' => 'subjects.delete',
            ],
            [
                'feature_name' => 'View Subject groups',
                'created_at' => now(),
                'route_name' => 'subject_groups.index',
            ],
            [
                'feature_name' => 'Create Subject groups',
                'created_at' => now(),
                'route_name' => 'subject_groups.create,subject_groups.store',
            ],
            [
                'feature_name' => 'Edit Subject groups',
                'created_at' => now(),
                'route_name' => 'subject_groups.edit,subject_groups.update',
            ],
            [
                'feature_name' => 'Delete Subject groups',
                'created_at' => now(),
                'route_name' => 'subject_groups.delete',
            ],
            [
                'feature_name' => 'View Subject group items',
                'created_at' => now(),
                'route_name' => 'subject_group_items.index',
            ],
            [
                'feature_name' => 'Create Subject group items',
                'created_at' => now(),
                'route_name' => 'subject_group_items.create,subject_group_items.store',
            ],
            [
                'feature_name' => 'Edit Subject group items',
                'created_at' => now(),
                'route_name' => 'subject_group_items.edit,subject_group_items.update',
            ],
            [
                'feature_name' => 'Delete Subject group items',
                'created_at' => now(),
                'route_name' => 'subject_group_items.delete',
            ],
            [
                'feature_name' => 'View Class room subjects',
                'created_at' => now(),
                'route_name' => 'class_room_subjects.index',
            ],
            [
                'feature_name' => 'Create Class room subjects',
                'created_at' => now(),
                'route_name' => 'class_room_subjects.create,class_room_subjects.store',
            ],
            [
                'feature_name' => 'Edit Class room subjects',
                'created_at' => now(),
                'route_name' => 'class_room_subjects.edit,class_room_subjects.update',
            ],
            [
                'feature_name' => 'Delete Class room subjects',
                'created_at' => now(),
                'route_name' => 'class_room_subjects.delete',
            ],
            [
                'feature_name' => 'View Teacher subjects',
                'created_at' => now(),
                'route_name' => 'teacher_subjects.index',
            ],
            [
                'feature_name' => 'Create Teacher subjects',
                'created_at' => now(),
                'route_name' => 'teacher_subjects.create,teacher_subjects.store',
            ],
            [
                'feature_name' => 'Edit Teacher subjects',
                'created_at' => now(),
                'route_name' => 'teacher_subjects.edit,teacher_subjects.update',
            ],
            [
                'feature_name' => 'Delete Teacher subjects',
                'created_at' => now(),
                'route_name' => 'teacher_subjects.delete',
            ],
            [
                'feature_name' => 'View Time Table',
                'created_at' => now(),
                'route_name' => 'schedules.index',
            ],
            [
                'feature_name' => 'Create Time Table',
                'created_at' => now(),
                'route_name' => 'schedules.create,schedules.store',
            ],
            [
                'feature_name' => 'Edit Time Table',
                'created_at' => now(),
                'route_name' => 'schedules.edit,schedules.update',
            ],
            [
                'feature_name' => 'Delete Time Table',
                'created_at' => now(),
                'route_name' => 'schedules.delete',
            ],
           
            [
                'feature_name' => 'View Admissions',
                'created_at' => now(),
                'route_name' => 'student_class_rooms.index',
            ],
            [
                'feature_name' => 'Create Admissions',
                'created_at' => now(),
                'route_name' => 'student_class_rooms.create,student_class_rooms.store',
            ],
            [
                'feature_name' => 'Edit Admissions',
                'created_at' => now(),
                'route_name' => 'student_class_rooms.edit,student_class_rooms.update',
            ],
            [
                'feature_name' => 'Delete Admissions',
                'created_at' => now(),
                'route_name' => 'student_class_rooms.delete',
            ],
            [
                'feature_name' => 'View Student Addresses',
                'created_at' => now(),
                'route_name' => 'student_addresses.index',
            ],
            [
                'feature_name' => 'Create Student Addresses',
                'created_at' => now(),
                'route_name' => 'student_addresses.create,student_addresses.store',
            ],
            [
                'feature_name' => 'Edit Student Addresses',
                'created_at' => now(),
                'route_name' => 'student_addresses.edit,student_addresses.update',
            ],
            [
                'feature_name' => 'Delete Student Addresses',
                'created_at' => now(),
                'route_name' => 'student_addresses.delete',
            ],
            [
                'feature_name' => 'View Exams',
                'created_at' => now(),
                'route_name' => 'exams.index',
            ],
            [
                'feature_name' => 'Create Exams',
                'created_at' => now(),
                'route_name' => 'exams.create,exams.store',
            ],
            [
                'feature_name' => 'Edit Exams',
                'created_at' => now(),
                'route_name' => 'exams.edit,exams.update',
            ],
            [
                'feature_name' => 'Delete Exams',
                'created_at' => now(),
                'route_name' => 'exams.delete',
            ],
            [
                'feature_name' => 'View Marks Sheet',
                'created_at' => now(),
                'route_name' => 'exams.get_marks_sheet',
            ],
            [
                'feature_name' => 'Export Marks Sheet',
                'created_at' => now(),
                'route_name' => 'exams.export_marks_sheet',
            ],
            [
                'feature_name' => 'ُSchedule Exam',
                'created_at' => now(),
                'route_name' => 'exams.schedule',
            ],
            [
                'feature_name' => 'View Exam Results',
                'created_at' => now(),
                'route_name' => 'exam_results.index',
            ],
            [
                'feature_name' => 'Create Exam Results',
                'created_at' => now(),
                'route_name' => 'exam_results.store_in_batch',
            ],
            [
                'feature_name' => 'Import & Export Results',
                'created_at' => now(),
                'route_name' => 'exam_results.import,exam_results.export',
            ],
            [
                'feature_name' => 'Delete Exam Results',
                'created_at' => now(),
                'route_name' => 'exam_results.delete',
            ],
            [
                'feature_name' => 'View Exam Types',
                'created_at' => now(),
                'route_name' => 'exam_types.index',
            ],
            [
                'feature_name' => 'Create Exam Types',
                'created_at' => now(),
                'route_name' => 'exam_types.create,exam_types.store',
            ],
            [
                'feature_name' => 'Edit Exam Types',
                'created_at' => now(),
                'route_name' => 'exam_types.edit,exam_types.update',
            ],
            [
                'feature_name' => 'Delete Exam Types',
                'created_at' => now(),
                'route_name' => 'exam_types.delete',
            ],
            [
                'feature_name' => 'View Exam Groups',
                'created_at' => now(),
                'route_name' => 'exam_groups.index',
            ],
            [
                'feature_name' => 'Create Exam Groups',
                'created_at' => now(),
                'route_name' => 'exam_groups.create,exam_groups.store',
            ],
            [
                'feature_name' => 'Edit Exam Groups',
                'created_at' => now(),
                'route_name' => 'exam_groups.edit,exam_groups.update',
            ],
            [
                'feature_name' => 'Delete Exam Groups',
                'created_at' => now(),
                'route_name' => 'exam_groups.delete',
            ],
            [
                'feature_name' => 'Exam Group Items',
                'created_at' => now(),
                'route_name' => 'exam_group_items.index',
            ],
            [
                'feature_name' => 'Add Exam',
                'created_at' => now(),
                'route_name' => 'exam_group_items.add_exam',
            ],
            [
                'feature_name' => 'View Exam Group Item',
                'created_at' => now(),
                'route_name' => 'exam_group_items.index',
            ],
            [
                'feature_name' => 'Create Exam Group Item',
                'created_at' => now(),
                'route_name' => 'exam_group_items.create,exam_group_items.store',
            ],
            [
                'feature_name' => 'Edit Exam Group Item',
                'created_at' => now(),
                'route_name' => 'exam_group_items.edit,exam_group_items.update',
            ],
            [
                'feature_name' => 'Delete Exam Group Item',
                'created_at' => now(),
                'route_name' => 'exam_group_items.delete',
            ],
            [
                'feature_name' => 'Add Subjects to exam',
                'created_at' => now(),
                'route_name' => 'exam_group_items.add_subjects',
            ],
            [
                'feature_name' => 'Add Students to exam',
                'created_at' => now(),
                'route_name' => 'exam_group_items.add_students',
            ],
            [
                'feature_name' => 'View Gradings',
                'created_at' => now(),
                'route_name' => 'gradings.index',
            ],
            [
                'feature_name' => 'Create Gradings',
                'created_at' => now(),
                'route_name' => 'gradings.create,gradings.store',
            ],
            [
                'feature_name' => 'Edit Gradings',
                'created_at' => now(),
                'route_name' => 'gradings.edit,gradings.update',
            ],
            [
                'feature_name' => 'Delete Gradings',
                'created_at' => now(),
                'route_name' => 'gradings.delete',
            ],
            [
                'feature_name' => 'View Fees',
                'created_at' => now(),
                'route_name' => 'fees.index',
            ],
            [
                'feature_name' => 'Create Fees',
                'created_at' => now(),
                'route_name' => 'fees.create,fees.store',
            ],
            [
                'feature_name' => 'Edit Fees',
                'created_at' => now(),
                'route_name' => 'fees.edit,fees.update',
            ],
            [
                'feature_name' => 'Delete Fees',
                'created_at' => now(),
                'route_name' => 'fees.delete',
            ],
            [
                'feature_name' => 'Fee Due List',
                'created_at' => now(),
                'route_name' => 'fees.due_list,fees.search_due_list',
            ],
            [
                'feature_name' => 'Fee Paid List',
                'created_at' => now(),
                'route_name' => 'fees.paid_list,fees.search_paid_list',
            ],
            [
                'feature_name' => 'Collect Fees',
                'created_at' => now(),
                'route_name' => 'fees.collect_fees',
            ],
            [
                'feature_name' => 'Save Fee Payments',
                'created_at' => now(),
                'route_name' => 'fees.save_payments',
            ],
            [
                'feature_name' => 'Save Student Payment',
                'created_at' => now(),
                'route_name' => 'fees.save_student_payment',
            ],
            [
                'feature_name' => 'Cancel Fee',
                'created_at' => now(),
                'route_name' => 'fees.cancel_fee',
            ],
            [
                'feature_name' => 'Fee Types',
                'created_at' => now(),
                'route_name' => 'fee_types.index',
            ],
            [
                'feature_name' => 'Create Fee Types',
                'created_at' => now(),
                'route_name' => 'fee_types.create,fee_types.store',
            ],
            [
                'feature_name' => 'Delete Fee Types',
                'created_at' => now(),
                'route_name' => 'fee_types.delete',
            ],
            [
                'feature_name' => 'Edit Fee Types',
                'created_at' => now(),
                'route_name' => 'fee_types.edit,fee_types.update',
            ],
            [
                'feature_name' => 'View Attendances',
                'created_at' => now(),
                'route_name' => 'attendances.index',
            ],
            [
                'feature_name' => 'Create Attendances',
                'created_at' => now(),
                'route_name' => 'attendances.create,attendances.store',
            ],
            [
                'feature_name' => 'Edit Attendances',
                'created_at' => now(),
                'route_name' => 'attendances.edit,attendances.update',
            ],
            [
                'feature_name' => 'Delete Attendances',
                'created_at' => now(),
                'route_name' => 'attendances.delete',
            ],
            [
                'feature_name' => 'View Attendance Results',
                'created_at' => now(),
                'route_name' => 'attendance_results.index',
            ],
            [
                'feature_name' => 'Create Attendance Results',
                'created_at' => now(),
                'route_name' => 'attendance_results.create,attendance_results.store',
            ],
            [
                'feature_name' => 'Edit Attendance Results',
                'created_at' => now(),
                'route_name' => 'attendance_results.edit,attendance_results.update',
            ],
            [
                'feature_name' => 'Delete Attendance Results',
                'created_at' => now(),
                'route_name' => 'attendance_results.delete',
            ],
            [
                'feature_name' => 'Attendance Results Statuses',
                'created_at' => now(),
                'route_name' => 'attendance_result_statuses.index',
            ],
            [
                'feature_name' => 'View Leaves',
                'created_at' => now(),
                'route_name' => 'leaves.index',
            ],
            [
                'feature_name' => 'Create Leaves',
                'created_at' => now(),
                'route_name' => 'leaves.create,leaves.store',
            ],
            [
                'feature_name' => 'Edit Leaves',
                'created_at' => now(),
                'route_name' => 'leaves.edit,leaves.update',
            ],
            [
                'feature_name' => 'Delete Leaves',
                'created_at' => now(),
                'route_name' => 'leaves.delete',
            ],
            [
                'feature_name' => 'View Teacher Attendances',
                'created_at' => now(),
                'route_name' => 'teacher_attendances.index',
            ],
            [
                'feature_name' => 'Create Teacher Attendances',
                'created_at' => now(),
                'route_name' => 'teacher_attendances.create,teacher_attendances.store',
            ],
            [
                'feature_name' => 'Edit Teacher Attendances',
                'created_at' => now(),
                'route_name' => 'teacher_attendances.edit,teacher_attendances.update',
            ],
            [
                'feature_name' => 'Delete Teacher Attendances',
                'created_at' => now(),
                'route_name' => 'teacher_attendances.delete',
            ],
            [
                'feature_name' => 'View Chart of accounts',
                'created_at' => now(),
                'route_name' => 'finance.accounts',
            ],
            [
                'feature_name' => 'Create account',
                'created_at' => now(),
                'route_name' => 'finance.accounts.create,finance.accounts.store',
            ],
            [
                'feature_name' => 'Edit account',
                'created_at' => now(),
                'route_name' => 'finance.accounts.edit',
            ],
            [
                'feature_name' => 'View Account Transactions',
                'created_at' => now(),
                'route_name' => 'finance.account_transactions',
            ],
            [
                'feature_name' => 'Register beginning balance',
                'created_at' => now(),
                'route_name' => 'finance.register_beginning_balance',
            ],
            [
                'feature_name' => 'Journal Entry',
                'created_at' => now(),
                'route_name' => 'finance.journal.index',
            ],
            [
                'feature_name' => 'Create Journal Entry',
                'created_at' => now(),
                'route_name' => 'finance.journal.store',
            ],
            [
                'feature_name' => 'Balance Sheet',
                'created_at' => now(),
                'route_name' => 'finance.balance_sheet.index',
            ],
            [
                'feature_name' => 'Income Statement',
                'created_at' => now(),
                'route_name' => 'finance.income_statement.index',
            ],
            [
                'feature_name' => 'Trial Balance',
                'created_at' => now(),
                'route_name' => 'finance.trial_balance.index',
            ],
            [
                'feature_name' => 'Expenses',
                'created_at' => now(),
                'route_name' => 'finance.expenses',
            ],
            [
                'feature_name' => 'Create Expense',
                'created_at' => now(),
                'route_name' => 'finance.new_expense,finance.store_expense',
            ],
            [
                'feature_name' => 'New Expense Category',
                'created_at' => now(),
                'route_name' => 'finance.new_expense_category,finance.store_expense_category',
            ],
            [
                'feature_name' => 'Pay expense',
                'created_at' => now(),
                'route_name' => 'finance.expenses.pay',
            ],
            [
                'feature_name' => 'Feature Permissions',
                'created_at' => now(),
                'route_name' => 'feature_permissions.index',
            ],
            [
                'feature_name' => 'Modify Feature Permissions',
                'created_at' => now(),
                'route_name' => 'feature_permissions.store',
            ],
         
        ]);
    }
}