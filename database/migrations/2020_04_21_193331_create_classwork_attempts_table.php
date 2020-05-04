<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassworkAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classwork_grades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->enum('value', [1,2,3,4])->default(1); // 1-Correct, 2-partly Correct, 3-Not Correct
            $table->float('point')->nullable();
            $table->text('remark')->nullable();
            // $table->integer('count')->default(0);
            $table->unsignedInteger('classwork_id');
            $table->unsignedInteger('attempt_id');
            $table->timestamps();
            $table->softDeletes();
            $table->userstamps();

            $table->foreign('classwork_id')->references('id')->on('questions');
            $table->foreign('attempt_id')->references('id')->on('classwork_attempts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classwork_grades');
    }
}
