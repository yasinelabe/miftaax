<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('expense_types')->insert([
            ['name' => 'ONE TIME EXPENSE'],
            ['name' => 'WEEKLY EXPENSE'],
            ['name' => 'MONTHLY EXPENSE']
        ]);
    }
}