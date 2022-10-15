<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeeTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fee_types')->insert([
            [
                'name' => 'Monthly',
            ],
            [
                'name' => 'Exam fee',
            ],
            [
                'name' => 'Graduation fee'
            ],
            [
                'name' => 'Other fee',
            ],
        ]);
    }
}