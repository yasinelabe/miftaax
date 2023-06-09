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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('plate_number');
            $table->string('vehicle_model');
            $table->string('year_made');
            $table->string('registration_number');
            $table->string('chasis_number');
            $table->string('max_seating_capacity');
            $table->string('driver_name');
            $table->string('driver_licence');
            $table->string('driver_contact');
            $table->text('image');
            $table->text('note');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
};
