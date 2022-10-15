<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['username' => 'admin', 'password' => bcrypt('admin'), 'role_id' => 1],
            ['username' => 'user', 'password' => bcrypt('user'), 'role_id' => 2],
        ]);
    }
}