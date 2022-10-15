<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountTransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('account_transaction_types')->insert(
            [
                [
                    'type' => 'debit',
                ],
                [
                    'type' => 'credit',
                    
                ]
            ]
        );
    }
}
