<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained('accounts')->cascadeOnDelete();
            $table->foreignId('account_transaction_type_id')->constrained('account_transaction_types')->cascadeOnDelete();
            $table->string('amount')->default(0);
            $table->string('balance')->default(0);
            $table->text('description')->nullable()->default(null);
            $table->timestamp('transaction_date')->useCurrent();
            $table->string('student_id')->nullable()->default(null);
            $table->string('teacher_id')->nullable()->default(null);
            $table->string('staff_id')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_transactions');
    }
}