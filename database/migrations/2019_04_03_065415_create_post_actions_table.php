<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->comment('User who performed the action');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('post_id')->unsigned()->comment('Post on which action is performed');
            $table->foreign('post_id')->references('id')->on('posts');
            $table->tinyInteger('type')->comment('0 - like, 1 - comment, 2 - share');
            $table->string('title');
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_actions');
    }
}
