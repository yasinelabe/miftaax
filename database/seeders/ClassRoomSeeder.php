<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('class_rooms')->insert([
            [
                'name' => '1A-2022',
                'academic_year_id'=>5,
                'shift_id' => 1
            ],
        ]);
    }
}
