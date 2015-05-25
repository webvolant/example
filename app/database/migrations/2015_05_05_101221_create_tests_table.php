<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration {

    public function up() {


        Schema::create('klinika_tests', function($table)
        {
            $table->increments('id');
            $table->integer('klinik_id')->unsigned();
            $table->foreign('klinik_id')->references('id')->on('kliniks')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('test_id')->unsigned();
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade')->onUpdate('cascade');
            $table->string('price', 255);
            $table->string('link_pivot', 255);
            $table->timestamps();
            $table->softDeletes();

        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('tests');
    }

}
