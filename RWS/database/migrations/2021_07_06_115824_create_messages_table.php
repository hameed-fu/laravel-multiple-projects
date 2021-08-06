<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->text('message');
            $table->timestamps();
        });

        // Schema::create('private_messages', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('sender_id')->unsigned();
        //     $table->integer('receiver_id')->unsigned();
        //     $table->string('subject');
        //     $table->text('message');
        //     $table->boolean('read');
        //     $table->timestamps();

        //     $table->index('sender_id');
        //     $table->index(['sender_id', 'read']);
        //     $table->index('receiver_id');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
