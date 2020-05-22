<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassworkGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        Schema::create('classwork_attempts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('value');
            // $table->integer('count')->default(0);
            $table->enum('type', [1,2,3])->default(1); // 1 - assignment, 2 - question, 3 - quiz
            $table->unsignedInteger('classwork_id'); //type_id
            $table->unsignedInteger('answer_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->softDeletes();
            $table->userstamps();

            $table->foreign('classwork_id')->references('id')->on('questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classwork_attempts');
    }
}
