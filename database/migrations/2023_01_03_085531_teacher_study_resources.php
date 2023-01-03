<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TeacherStudyResources extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_study_resources', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('study_resource_id')->unsigned();
            $table->timestamps();

            $table->foreign('study_resource_id')->references('id')->on('study_resources')->onDelete('cascade');
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
