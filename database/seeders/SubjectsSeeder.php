<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            [
                'name' => 'Quran',
                'code' => 'QRN',
            ],
            [
                'name' => 'Mathematics',
                'code' => 'MT',
            ],
            [
                'name' => 'Arabic',
                'code' => 'ARB',
            ],
            [
                'name' => 'English',
                'code' => 'ENG',
            ],
            [
                'name' => 'Science',
                'code' => 'SC',
            ],
            [
                'name' => 'Social',
                'code' => 'SOC',
            ],
            [
                'name' => 'History',
                'code' => 'HST',
            ],
           
        ]);
    }
}
