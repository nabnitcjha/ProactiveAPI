<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_schedule', function (Blueprint $table) {
            $table->increments('id');
            $table->string('topic');
            $table->integer('teacher_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->text('duration')->nullable();
            $table->longText('zoom_link')->nullable();
            $table->integer('class_repeat')->default('0');
            $table->integer('class_complete')->default('0');
            $table->text('selected_day')->nullable();
            $table->string('class_unique_id');
            $table->integer('study_resource_id')->unsigned()->nullable();
            $table->integer('assignment_id')->unsigned()->nullable();
            $table->string('description');
            $table->timestamps();

            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('study_resource_id')->references('id')->on('study_resources')->onDelete('cascade');
            $table->foreign('assignment_id')->references('id')->on('assignments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_schedule');
    }
}
