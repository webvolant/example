<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function ($table) {
            $table->increments('id');
            $table->string('email');
            $table->string('fio');
            $table->string('link');

            $table->string('password');
            $table->string('remember_token');
            $table->string('role');

            $table->string('doma');
            $table->string('dogovor');
            $table->text('klinika_name');

            $table->string('phone');

            $table->string('experience');
            $table->text('rang');

            //$table->string('phone_dom');
            //$table->string('phone_mob');
            $table->string('price');
            $table->text('price_include');
            $table->text('grafik');
            $table->string('det_doctor');
            $table->string('viesd_na_dom');

            $table->text('profil');
            $table->text('description');
            $table->text('education');
            $table->text('qualif');

            $table->string('logo');


            $table->string('status');
            $table->string('rating');
            $table->string('rating_second');
            $table->string('count_otzivi');

            //$table->string('key_klinika'); ключ на выпадающий список оператор

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
        Schema::dropIfExists('users');
    }

}
