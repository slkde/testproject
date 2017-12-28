<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ask_user', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('username')->nullable();
            $table->string('nickname')->nullable();
            $table->bigInteger('phone')->nullable()->unsigned()->unique();
            $table->string('email')->nullable()->unique();
            $table->string('password');
            $table->tinyInteger('sex')->unsigned()->nullable();
            $table->string('photo')->nullable();
            $table->integer('score')->unsigned()->default(100);
            $table->string('identty')->default(0);
            $table->string('autograph')->nullable();
            $table->string('job')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ask_user');
    }
}
