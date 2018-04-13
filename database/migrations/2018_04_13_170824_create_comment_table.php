<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('game_id')->unsigned();
            $table->string('comment');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('game_id')->references('id')->on('game')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment');
    }
}
