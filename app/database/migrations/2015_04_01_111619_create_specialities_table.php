<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::create('specialities', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('name_alias');
            $table->string('specialisation');
            $table->string('specialisation_alias');

            $table->text('description');
            $table->text('description_specialisation');

            $table->timestamps();
        });

        Schema::create('user_specialities', function($table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('speciality_id')->unsigned();
            $table->foreign('speciality_id')->references('id')->on('specialities');
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
        Schema::dropIfExists('user_specialities');
        Schema::dropIfExists('specialities');

    }

}
