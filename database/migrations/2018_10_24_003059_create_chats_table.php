<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_from_id')->unsigned();
            $table->foreign('user_from_id')->references('id')->on('users');
            $table->integer('user_to_id')->unsigned();
            $table->foreign('user_to_id')->references('id')->on('users');
            $table->text('chat');
            $table->smallInteger('seen')->default(0);
            $table->timestamps();
            
            $table->index(['user_to_id', 'user_from_id']);
            $table->index('user_from_id'); 

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chats');
    }
}
