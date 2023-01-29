<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            OperationSeeder::class,
            RoleSeeder::class,
            UsersSeeder::class,
            FeatureSeeder::class,
            GuardianSeeder::class,
            BloodGroupSeeder::class,
            StudentAddressSeeder::class,
            StudentSeeder::class,
            AcademicYearSeeder::class,
            ShiftsSeeder::class,
            ExamTypeSeeder::class,
            GradingSeeder::class,
            ClassRoomSeeder::class,
            FeeTypesSeeder::class,
            SubjectsSeeder::class,
            AccountTypesSeeder::class,
            AccountTransactionTypeSeeder::class,
            AccountsSeeder::class,
            ExpenseTypeSeeder::class,
            AttendanceResultStatusSeeder::class,
            MainMenuSeeder::class,
            SubMenuSeeder::class,
            LowMenuSeeder::class
        ]);
    }
}
