<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('name');
            $table->enum('type', [1,2])->default(1); // 1 - compulsory, 2 - optional
            $table->unsignedInteger('class_id');
            $table->unsignedInteger('section_id');
            $table->unsignedInteger('teacher_id');
            $table->unsignedInteger('subject_id');
            $table->enum('status', [0,1])->default(1);
            $table->enum('archive', [0,1])->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->userstamps();

            $table->foreign('class_id')->references('id')->on('i_classes');
            $table->foreign('teacher_id')->references('id')->on('employees');
            $table->foreign('section_id')->references('id')->on('sections');
            $table->foreign('subject_id')->references('id')->on('subjects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topics');
    }
}
