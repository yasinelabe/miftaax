<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('account_types')->insert(
            [
                [
                    'name' => 'Assets',
                ],
                [
                    'name' => 'Liabilities',
                ],
                [
                    'name' => 'Expenses',
                ],
                [
                    'name' => 'Income',
                ],
                [
                    'name' => 'Equity',
                ]
            ]

        );
    }
}
