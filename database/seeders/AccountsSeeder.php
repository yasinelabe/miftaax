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
                    'account_name' => 'cash on hand',
                    'account_type_id' => 1,
                    'parent_id' => NULL,
                ],
                [
                    'account_name' => 'Bank',
                    'account_type_id' => 1,
                    'parent_id' => NULL,
                ],
                [
                    'account_name' => 'Mobile money',
                    'account_type_id' => 1,
                    'parent_id' => NULL,
                ],
                [
                    'account_name' => 'inventory',
                    'account_type_id' => 1,
                    'parent_id' => NULL,
                ],
                [
                    'account_name' => 'prepaid inventory',
                    'account_type_id' => 1,
                    'parent_id ' => NULL,
                ],
                [
                    'account_name' => 'goods received not invoiced',
                    'account_type_id' => 2,
                    'parent_id' => NULL,
                ],
                [
                    'account_name' => 'accounts payable',
                    'account_type_id' => 2,
                    'parent_id' => NULL,
                ],
                [
                    'account_name' => 'expenses',
                    'account_type_id' => 3,
                    'parent_id' => NULL,
                ],
                [
                    'account_name' => 'revenue',
                    'account_type_id' => 4,
                    'parent_id' => NULL,
                ],
                [
                    'account_name' => 'equity',
                    'account_type_id' => 5,
                    'parent_id' => NULL,
                ],
                [
                    'account_name' => 'cost of goods sold',
                    'account_type_id' => 3,
                    'parent_id' => NULL,
                ],
                [
                    'account_name' => 'accounts receivable',
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
