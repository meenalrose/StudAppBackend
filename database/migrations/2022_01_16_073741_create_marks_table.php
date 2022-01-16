<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('studentId');
            $table->string('maths');
            $table->string('science');
            $table->string('history');
            $table->integer('term');
            $table->integer('totalmark');
            $table->integer('is_deleted');
            $table->timestamps();

            $table->foreign('studentId')->references('id')->on('students')
            ->onUpdate('no action')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marks');
    }
}
