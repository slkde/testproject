<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ask_question', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->text('content');
            $table->integer('topic_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('photo')->nullable();
            $table->tinyInteger('status')->unsigned()->default(0);
            $table->integer('bonus')->unsigned()->default(0);
            $table->integer('support')->unsigned()->nullable()->default(0);
            $table->integer('price')->unsigned()->nullable()->default(0);
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
        Schema::drop('ask_question');
    }
}
