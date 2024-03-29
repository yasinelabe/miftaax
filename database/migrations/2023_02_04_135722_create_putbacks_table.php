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
        Schema::create('putbacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('taken_book_id')->constrained('taken_books');
            $table->dateTime('returned_date')->useCurrent();
            $table->text('note');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('putbacks');
    }
};
