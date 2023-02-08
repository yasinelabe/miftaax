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
        Schema::create('hostel_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('room_number');
            $table->string('number_of_students');
            $table->string('status')->default('active');
            $table->foreignId('hostel_id')->constrained('hostels');
            $table->foreignId('hostel_room_type_id')->constrained('hostel_room_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hostel_rooms');
    }
};
