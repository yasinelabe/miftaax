<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            'fullname' => 'Cumar jaamac',
            'gender'=> 'male',
            'guardian_id' => 1,
            'blood_group_id' => 1,
            'has_medical_emergency' =>1,
            'is_active' => 1,
            'is_graduated' => 0,
            'fee_balance' => 0,
            'fee_amount' => 50,
        ]);
    }
}