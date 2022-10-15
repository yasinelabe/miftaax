<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuardianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('guardians')->insert(
            [
                [
                    'fullname' => 'Testing parent',
                    'tell' => '1650406600',
                    'family_link' => 'mom'
                ]
            ]
        );
    }
}
