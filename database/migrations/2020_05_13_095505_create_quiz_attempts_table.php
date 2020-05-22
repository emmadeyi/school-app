<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_attempts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('value');
            $table->unsignedInteger('quiz_id'); //type_id
            $table->unsignedInteger('question_id'); //type_id
            $table->unsignedInteger('answer_id')->nullable();
            $table->unsignedInteger('user_id');
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
        Schema::dropIfExists('quiz_attempts');
    }
}
