<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKliniksTable extends Migration {

    public function up()
    {
        Schema::create('kliniks', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('link');
            $table->string('phone');
            $table->string('email');

            $table->string('fio');
            $table->text('address');
            $table->text('grafik');

            $table->text('description');
            $table->string('logo');
            $table->string('status');
            $table->string('price');
            $table->text('keywords');

            $table->string('rating');
            $table->string('rating_second');
            $table->string('count_otzivi');

            $table->string('type');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('user_kliniks', function($table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('klinik_id')->unsigned();
            $table->foreign('klinik_id')->references('id')->on('kliniks')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('photos', function($table)
        {
            $table->increments('id');
            $table->integer('klinik_id')->unsigned();
            $table->foreign('klinik_id')->references('id')->on('kliniks')->onDelete('cascade')->onUpdate('cascade');
            $table->string('path_small');
            $table->string('path_big');
            $table->string('path');
            //$table->integer('klinik_id')->unsigned();
            //$table->foreign('klinik_id')->references('id')->on('kliniks');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kliniks');
        Schema::dropIfExists('user_kliniks');
    }

}
