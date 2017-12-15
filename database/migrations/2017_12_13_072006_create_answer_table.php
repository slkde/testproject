<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ask_answer', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('question_id')->unsigned()->default(0);
            $table->integer('answer_to_id')->unsigned()->default(0);
            $table->integer('user_id')->unsigned();
            $table->text('answer_content');
            $table->integer('support')->unsigned()->default(0);
            $table->tinyInteger('answer_status')->unsigned()->default(0);
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ask_answer');
    }
}
