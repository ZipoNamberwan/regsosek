<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShiftStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_shift', function (Blueprint $table) {
            $table->id()->autoincrement();
            $table->string('name');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('status_shift_id')->nullable()->constrained('status_shift');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
