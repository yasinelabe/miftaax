<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('academic_years')->insert([
            [
                'year' => '2026-27',
                'is_active' =>0
            ],
            [
                'year' => '2025-26',
                'is_active' =>0
            ],
            [
                'year' => '2024-25',
                'is_active' =>0
            ],
            [
                'year' => '2023-24',
                'is_active' =>0
            ],
            [
                'year' => '2022-23',
                'is_active' =>1
            ],
            [
                'year' => '2021-22',
                'is_active' =>0
            ],
            [
                'year' => '2020-21',
                'is_active' =>0
            ],
            [
                'year' => '2019-20',
                'is_active' =>0
            ],
            [
                'year' => '2018-19',
                'is_active' =>0
            ],
            [
                'year' => '2017-18',
                'is_active' =>0
            ],
  
        ]);
    }
}
