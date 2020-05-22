<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('answer');
            $table->boolean('correct')->default(false);
            $table->unsignedInteger('quiz_id');
            $table->unsignedInteger('question_id');
            $table->timestamps();
            $table->softDeletes();
            $table->userstamps();

            $table->foreign('quiz_id')->references('id')->on('quizzes');
            $table->foreign('question_id')->references('id')->on('quiz_questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_answers');
    }
}
