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
        Schema::create('time_tables', function (Blueprint $table) {
            $table->id();
            
            $table->string('name');
            $table->foreignId('class_room_id')->constrained('class_rooms')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_tables');
    }




};