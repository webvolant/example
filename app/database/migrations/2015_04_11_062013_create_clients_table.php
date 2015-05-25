<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration {

    public function up()
    {
        Schema::create('clients', function ($table) {
            $table->increments('id');
            $table->string('email');
            $table->string('fio');
            $table->string('link');

            $table->string('phone');
            $table->string('address');
            $table->text('comment');

            $table->timestamps();
            $table->softDeletes();
        });


    }

    public function down()
    {
        Schema::dropIfExists('clients');

    }

}
