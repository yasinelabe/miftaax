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
        Schema::create('exam_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_group_item_id')->constrained('exam_group_items')->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained('subjects');
            $table->date('date');
            $table->time('time');
            $table->string('duration');
            $table->string('credit_hours');
            $table->string('max_marks');
            $table->string('min_marks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_subjects');
    }
};
