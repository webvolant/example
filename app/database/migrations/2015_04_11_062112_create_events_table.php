<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration {

    public function up()
    {
        Schema::create('status', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('events', function ($table) {
            $table->increments('id');
            //$table->string('email');
            //$table->string('phone');

            $table->integer('status_id')->unsigned()->nullable();
            $table->foreign('status_id')->references('id')->on('status');

            $table->string('flag')->nullable();


            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('order_id')->unsigned()->nullable();
            $table->foreign('order_id')->references('id')->on('orders');

            $table->string('date_begin')->nullable();
            $table->string('date_end')->nullable();
            $table->string('date_success')->nullable();

            $table->text('comment')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });


    }

    public function down()
    {
        Schema::dropIfExists('status');
        Schema::dropIfExists('events');
    }

}
