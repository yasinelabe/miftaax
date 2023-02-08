<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LibraryMemberTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('library_member_types')->insert([
            ['name' => 'Student'],
            ['name' => 'Teacher'],
            ['name' => 'Staff']
        ]);
    }
}
