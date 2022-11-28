<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        DB::table('accounts')->insert(
            [
                [
                    'account_name' => 'Cash',
                    'account_type_id' => 1,
                    'parent_id' => NULL,
                ],
                [
                    'account_name' => 'Bank',
                    'account_type_id' => 1,
                    'parent_id' => NULL,
                ],
                [
                    'account_name' => 'Non current assets',
                    'account_type_id' => 1,
                    'parent_id' => NULL,
                ],
                [
                    'account_name' => 'Inventory',
                    'account_type_id' => 1,
                    'parent_id' => NULL,
                ],
                [
                    'account_name' => 'Fixed assets',
                    'account_type_id' => 1,
                    'parent_id ' => NULL,
                ],
                [
                    'account_name' => 'Non current liabilities',
                    'account_type_id' => 2,
                    'parent_id' => NULL,
                ],
                [
                    'account_name' => 'Accounts payable',
                    'account_type_id' => 2,
                    'parent_id' => NULL,
                ],
                [
                    'account_name' => 'Expenses',
                    'account_type_id' => 3,
                    'parent_id' => NULL,
                ],
                [
                    'account_name' => 'Revenue',
                    'account_type_id' => 4,
                    'parent_id' => NULL,
                ],
                [
                    'account_name' => 'Equity',
                    'account_type_id' => 5,
                    'parent_id' => NULL,
                ],
                [
                    'account_name' => 'Cost of goods sold',
                    'account_type_id' => 3,
                    'parent_id' => NULL,
                ],
                [
                    'account_name' => 'Accounts receivable',
                    'account_type_id' => 1,
                    'parent_id' => NULL,
                ],
                [
                    'account_name' => 'Fee Income',
                    'account_type_id' => 4,
                    'parent_id' => 9,
                ],
               

            ]

        );
    }
}
