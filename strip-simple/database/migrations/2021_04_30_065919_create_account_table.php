<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('fname');
            $table->string('lname');
            $table->string('email');
            $table->string('contact');
            $table->string('fdate');
            $table->string('water');
            $table->string('nights');
            $table->string('education');
            $table->string('medical');
            $table->string('we');
            $table->string('food');
            $table->string('amount');

            $table->string('card_holder');
            $table->string('card_number');
            $table->string('csv');
            $table->string('expiration_month');
            $table->string('expiration_year');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account');
    }
}
