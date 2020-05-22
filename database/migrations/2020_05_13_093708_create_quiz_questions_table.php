<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('question');
            $table->float('points')->nullable();
            $table->enum('answer_type', [1,2])->default(1); // 1 - short answer, 2 - multiple choice
            $table->enum('editable_answer', [0,1])->default(1); // 1 - yes, 2 - no
            $table->unsignedInteger('quiz_id')->nullable();
            $table->enum('status', [0,1])->default(1);
            $table->enum('archive', [0,1])->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->userstamps();

            $table->foreign('quiz_id')->references('id')->on('quizzes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_questions');
    }
}
