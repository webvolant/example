<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrmTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crms', function ($table) {
            $table->increments('id');

            $table->text('info_before');
            $table->text('info_after');


            $table->text('object');
            $table->integer('object_id')->nullable();
            //$table->foreign('object_id')
            //    ->references('id')->on('users');

            //$table->string('user_id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')->on('users');

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
        Schema::dropIfExists('crms');
    }

}
