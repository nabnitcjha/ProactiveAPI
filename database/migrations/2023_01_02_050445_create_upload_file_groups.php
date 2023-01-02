<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadFileGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_file_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('file_group_id');
            $table->unsignedInteger('file_id');
            $table->timestamps();
        });

        Schema::create('upload_file', function (Blueprint $table) {
            $table->increments('id');
            $table->text('filename')->nullable();
            $table->text('original_filename')->nullable();
            $table->string('filebasepath', 255)->nullable();
            $table->string('filepath', 255)->nullable();
            $table->string('meme_type', 50)->nullable();
            $table->string('upload_type', 50)->nullable();
            $table->string('upload_size', 50)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('upload_file_groups');
    }
}
