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

        Schema::create('status_doc', function (Blueprint $table) {
            $table->id()->autoincrement();
            $table->string('name');
        });

        Schema::create('status_attendance', function (Blueprint $table) {
            $table->id()->autoincrement();
            $table->string('name');
        });

        Schema::create('entry_k', function (Blueprint $table) {
            $table->id()->autoincrement();
            $table->foreignId('sls_id')->constrained('sls');
            $table->integer('total_entry')->nullable();
            $table->date('begin');
            $table->date('finish')->nullable();
            $table->foreignId('status_id')->constrained('status');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('status_doc_id')->nullable()->constrained('status_doc');
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('attendance', function (Blueprint $table) {
            $table->id()->autoincrement();
            $table->foreignId('user_id')->constrained('users');
            $table->date('date');
            $table->dateTime('in')->nullable();
            $table->dateTime('out')->nullable();
            $table->foreignId('status_attendance_id')->nullable()->constrained('status_attendance');
            $table->text('note')->nullable();
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
