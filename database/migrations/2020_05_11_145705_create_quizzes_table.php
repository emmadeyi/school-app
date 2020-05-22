<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('title');
            $table->text('instructions')->nullable();
            $table->float('duration')->nullable();
            $table->string('due_date')->nullable();
            $table->enum('type', [1,2,3])->default(1); // 1- topic, 2 - subject, 3 exam
            $table->enum('question_type', [1,2,3,4])->default(4); // 1- topic, 2 - subject, 3 exam
            $table->integer('no_question')->default(0)->nullable();
            $table->enum('auto_grade', [0,1])->default(0); // 1 - yes, 2 - no
            $table->enum('constrained', [0,1])->default(0); // 1 - yes, 2 - no
            $table->unsignedInteger('constrain_id')->nullable();
            $table->unsignedInteger('constrain_type')->nullable();
            $table->unsignedInteger('class_id')->nullable();
            $table->unsignedInteger('section_id')->nullable();
            $table->unsignedInteger('teacher_id')->nullable();
            $table->unsignedInteger('subject_id')->nullable();
            $table->unsignedInteger('topic_id')->nullable();
            $table->enum('status', [0,1])->default(1);
            $table->enum('archive', [0,1])->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->userstamps();

            $table->foreign('class_id')->references('id')->on('i_classes');
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
        Schema::dropIfExists('quizzes');
    }
}
