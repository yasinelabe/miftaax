<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncomeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('income_types')->insert([
            ['name' => 'ONE TIME INCOME'],
            ['name' => 'WEEKLY INCOME'],
            ['name' => 'MONTHLY INCOME']
        ]);
    }
}