<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exam_types')->insert([
            // ['name' => 'General Purpose (Pass/Fail)'],
            ['name' => 'School Based Grading System'],
            // ['name' => 'GPA Grading System'],
        ]);
    }
}