<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gradings')->insert([
            [
                'from_marks' => '96',
                'to_marks' => '100',
                'grade' => 'A+',
                'exam_type_id' => 2,
            ],
            [
                'from_marks' => '90',
                'to_marks' => '95',
                'grade' => 'A',
                'exam_type_id' => 2
            ],
            [
                'from_marks' => '85',
                'to_marks' => '89',
                'grade' => 'A-',
                'exam_type_id' => 2,
            ],
            [
                'from_marks' => '80',
                'to_marks' => '84',
                'grade' => 'B+',
                'exam_type_id' => 2,
            ],
            [
                'from_marks' => '76',
                'to_marks' => '83',
                'grade' => 'B',
                'exam_type_id' => 2
            ],
            [
                'from_marks' => '70',
                'to_marks' => '82',
                'grade' => 'B-',
                'exam_type_id' => 2,
            ],
            [
                'from_marks' => '64',
                'to_marks' => '69',
                'grade' => 'C+',
                'exam_type_id' => 2,
            ],
            [
                'from_marks' => '56',
                'to_marks' => '63',
                'grade' => 'C',
                'exam_type_id' => 2
            ],
            [
                'from_marks' => '50',
                'to_marks' => '55',
                'grade' => 'C-',
                'exam_type_id' => 2,
            ],
            [
                'from_marks' => '0',
                'to_marks' => '49',
                'grade' => 'F',
                'exam_type_id' => 2
            ],
        ]);
    }
}
