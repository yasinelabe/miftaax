<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendanceResultStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attendance_result_statuses')->insert([
            ['name' => 'Present'],
            ['name' => 'Late'],
            ['name' => 'Absent'],
            ['name' => 'Half day']
        ]);
    }
}