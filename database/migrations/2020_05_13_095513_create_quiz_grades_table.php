<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_grades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->enum('value', [1,2,3,4])->default(1); // 1-Correct, 2-partly Correct, 3-Not Correct
            $table->float('point')->nullable();
            $table->text('remark')->nullable();
            $table->unsignedInteger('quiz_id');
            $table->unsignedInteger('question_id');
            $table->unsignedInteger('attempt_id');
            $table->timestamps();
            $table->softDeletes();
            $table->userstamps();

            $table->foreign('quiz_id')->references('id')->on('quizzes');
            $table->foreign('question_id')->references('id')->on('quiz_questions');
            $table->foreign('attempt_id')->references('id')->on('quiz_attempts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_grades');
    }
}
