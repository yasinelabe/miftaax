<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('assets')->insert([
            [
                'assets_name' => 'Users',
                'created_at' => now(),
                'route_name' => 'users.index',
            ],
            [
                'assets_name' => 'Roles',
                'created_at' => now(),
                'route_name' => 'roles.index',
            ],
            [
                'assets_name' => 'Role Permissions',
                'created_at' => now(),
                'route_name' => 'role_permissions.index',
            ],
            [
                'assets_name' => 'Accounts',
                'created_at' => now(),
                'route_name' => 'accounts.index',
            ],
            [
                'assets_name' => 'Finance',
                'created_at' => now(),
                'route_name' => 'finance.index',
            ],
            [
                'assets_name' => 'Guardians',
                'created_at' => now(),
                'route_name' => 'guardians.index',
            ],
            [
                'assets_name' => 'Teachers',
                'created_at' => now(),
                'route_name' => 'teachers.index',
            ],
            [
                'assets_name' => 'Students',
                'created_at' => now(),
                'route_name' => 'students.index',
            ],
            [
                'assets_name' => 'Class Rooms',
                'created_at' => now(),
                'route_name' => 'class_rooms.index',
            ],
            [
                'assets_name' => 'Shifts',
                'created_at' => now(),
                'route_name' => 'shifts.index',
            ],
            [
                'assets_name' => 'Subjects',
                'created_at' => now(),
                'route_name' => 'subjects.index',
            ],
            [
                'assets_name' => 'Subject Groups',
                'created_at' => now(),
                'route_name' => 'subject_groups.index',
            ],
            [
                'assets_name' => 'Subject Group Items',
                'created_at' => now(),
                'route_name' => 'subject_group_items.index',
            ],
            [
                'assets_name' => 'class room subjects',
                'created_at' => now(),
                'route_name' => 'class_room_subjects.index',
            ],
            [
                'assets_name' => 'Teacher Subjects',
                'created_at' => now(),
                'route_name' => 'teacher_subjects.index',
            ],
            [
                'assets_name' => 'Student Classes',
                'created_at' => now(),
                'route_name' => 'student_class_rooms.index',
            ],
            [
                'assets_name' => 'Exams',
                'created_at' => now(),
                'route_name' => 'exams.index',
            ],
            [
                'assets_name' => 'Exam Results',
                'created_at' => now(),
                'route_name' => 'exam_results.index',
            ],
            [
                'assets_name' => 'Exam Types',
                'created_at' => now(),
                'route_name' => 'exam_types.index',
            ],
            [
                'assets_name' => 'Exam Groups',
                'created_at' => now(),
                'route_name' => 'exam_groups.index',
            ],
            [
                'assets_name' => 'Exam Group Items',
                'created_at' => now(),
                'route_name' => 'exam_group_items.index',
            ],
            [
                'assets_name' => 'Gradings',
                'created_at' => now(),
                'route_name' => 'gradings.index',
            ],
            [
                'assets_name' => 'Fees',
                'created_at' => now(),
                'route_name' => 'fees.index',
            ],
            [
                'assets_name' => 'Fee Types',
                'created_at' => now(),
                'route_name' => 'fee_types.index',
            ],
            [
                'assets_name' => 'Attendances',
                'created_at' => now(),
                'route_name' => 'attendances.index',
            ],
            [
                'assets_name' => 'Attendance Results',
                'created_at' => now(),
                'route_name' => 'attendance_results.index',
            ],
            [
                'assets_name' => 'Attendance Results Statuses',
                'created_at' => now(),
                'route_name' => 'attendance_result_statuses.index',
            ],
            [
                'assets_name' => 'Leaves',
                'created_at' => now(),
                'route_name' => 'leaves.index',
            ],
         
        ]);
    }
}