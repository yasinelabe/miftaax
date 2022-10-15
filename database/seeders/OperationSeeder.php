<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OperationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('operations')->insert([
            ['operation_name' => 'create'],
            ['operation_name' => 'read'],
            ['operation_name' => 'update'],
            ['operation_name' => 'delete'],
        ]);
    }
}