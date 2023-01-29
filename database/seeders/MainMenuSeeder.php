<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('menus')->insert([
            [
                'name'=> 'Dashboard',
                'icon' => 'fa fa-dashboard',
                'link'=>"/"
            ],
            [
                'name'=> 'Academics',
                'icon' => 'fa fa-graduation-cap',
                'link'=>NULL
            ],
            [
                'name'=> 'Examination',
                'icon' => 'fa fa-question-circle',
                'link'=>NULL
            ],
            [
                'name'=> 'Fees Collection',
                'icon' => 'fa fa-money',
                'link'=>NULL
            ],
            [
                'name'=> 'Attendance',
                'icon' => 'fa fa-eye',
                'link'=>NULL
            ],
            [
                'name'=> 'Accounting',
                'icon' => 'fa fa-book',
                'link'=>NULL
            ],
            [
                'name'=> 'Registration',
                'icon' => 'fa fa-child',
                'link'=>NULL
            ],
            [
                'name'=> 'User Management',
                'icon' => 'fa fa-users',
                'link'=>NULL
            ],
        ]);
    }
}
