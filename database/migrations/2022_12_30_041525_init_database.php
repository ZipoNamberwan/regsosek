<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subdistrict', function (Blueprint $table) {
            $table->id()->autoincrement();
            $table->string('code');
            $table->string('name');
        });
        Schema::create('village', function (Blueprint $table) {
            $table->id()->autoincrement();
            $table->string('code');
            $table->string('name');
            $table->foreignId('subdistrict_id')->constrained('subdistrict');
        });
        Schema::create('sls', function (Blueprint $table) {
            $table->id()->autoincrement();
            $table->string('code');
            $table->string('name');
            $table->integer('total_k');
            $table->foreignId('village_id')->constrained('village');
        });

        Schema::create('status', function (Blueprint $table) {
            $table->id()->autoincrement();
            $table->string('name');
        });

        Schema::create('entry_k', function (Blueprint $table) {
            $table->id()->autoincrement();
            $table->foreignId('sls_id')->constrained('sls');
            $table->integer('total_entry');
            $table->date('begin');
            $table->date('finish');
            $table->foreignId('status_id')->constrained('status');
            $table->timestamps();
            $table->softDeletes();
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
