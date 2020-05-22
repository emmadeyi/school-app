<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiveClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_classes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('title');
            $table->string('url');
            $table->text('instructions')->nullable();
            $table->string('date');
            $table->string('time');
            $table->unsignedInteger('class_id');
            $table->unsignedInteger('section_id');
            $table->unsignedInteger('teacher_id');
            $table->unsignedInteger('topic_id')->nullable();
            $table->enum('status', [0,1])->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->userstamps();

            $table->foreign('class_id')->references('id')->on('i_classes');
            $table->foreign('teacher_id')->references('id')->on('employees');
            $table->foreign('section_id')->references('id')->on('sections');
            $table->foreign('topic_id')->references('id')->on('topics');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('live_classes');
    }
}
