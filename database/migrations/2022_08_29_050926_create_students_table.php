<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id()->startingValue(1000);
            $table->string('fullname');
            $table->string('gender');
            $table->foreignId('guardian_id')->constrained('guardians');
            $table->date('date_of_birth')->nullable(true)->default(NULL);
            $table->date('joined_date')->nullable(true)->default(NULL);      
            $table->foreignId('student_address_id')->constrained("student_addresses");
            $table->foreignId('blood_group_id');
            $table->boolean('has_medical_emergency');
            $table->boolean('is_active');
            $table->boolean('is_graduated'); 
            $table->string('fee_amount')->default('0'); 
            $table->string('fee_balance')->default('0');
            $table->integer('hostel_id')->nullable()->default(NULL);
            
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};