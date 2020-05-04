<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('title');
            $table->text('instructions')->nullable();
            $table->float('points')->nullable();
            $table->string('due_date')->nullable();
            $table->enum('type', [1,2])->default(1); 
            $table->enum('classwork_type', [1,2])->default(1); 
            $table->enum('answer_type', [1,2])->default(1); // 1 - short answer, 2 - multiple choice
            $table->enum('collaboration', [0,1])->default(1); // 1 - yes, 2 - no
            $table->enum('editable_answer', [0,1])->default(1); // 1 - yes, 2 - no
            $table->unsignedInteger('class_id');
            $table->unsignedInteger('section_id');
            $table->unsignedInteger('teacher_id');
            $table->unsignedInteger('subject_id')->nullable();
            $table->unsignedInteger('topic_id')->nullable();
            $table->enum('status', [0,1])->default(1);
            $table->enum('archive', [0,1])->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->userstamps();

            $table->foreign('class_id')->references('id')->on('i_classes');
            $table->foreign('teacher_id')->references('id')->on('employees');
            $table->foreign('section_id')->references('id')->on('sections');
            $table->foreign('subject_id')->references('id')->on('subjects');
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
        Schema::dropIfExists('questions');
    }
}
