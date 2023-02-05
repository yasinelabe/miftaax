<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('racks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('total_rows');
            $table->integer('total_columns');
            $table->string('total_shelves')->default(0);
        });

        DB::unprepared("CREATE TRIGGER TOTALSHELVES BEFORE INSERT ON  racks FOR EACH ROW SET NEW.total_shelves = NEW.total_rows*NEW.total_columns;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('racks');
        DB::statement('DROP TRIGGER `TOTALSHELVES`;');
    }
};
