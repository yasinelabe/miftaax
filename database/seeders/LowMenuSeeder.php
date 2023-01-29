<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LowMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('low_menus')->insert([
            [
                'name' => 'Admission List',
                'link' => '/student_class_rooms',
                'sub_menu_id' => 35
            ],
            [
                'name' => 'Admit By Student',
                'link' => '/student_class_rooms/create',
                'sub_menu_id' => 35
            ],
            [
                'name' => 'Admit By Batch',
                'link' => '/student_class_rooms/admin_in_batches',
                'sub_menu_id' => 35
            ]
        ]);
    }
}
