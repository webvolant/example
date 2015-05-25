<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('problems', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('link');
            $table->string('status');

            $table->text('description');
            $table->text('keywords');

            $table->integer('operator_id')->unsigned()->nullable();
            $table->foreign('operator_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('speciality_id')->unsigned()->nullable();
            $table->foreign('speciality_id')->references('id')->on('specialities')->onDelete('cascade')->onUpdate('cascade');


            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('articles', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('link');
            $table->string('status');

            $table->text('description');
            $table->text('keywords');

            $table->integer('operator_id')->unsigned()->nullable();
            $table->foreign('operator_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('speciality_id')->unsigned()->nullable();
            $table->foreign('speciality_id')->references('id')->on('specialities')->onDelete('cascade')->onUpdate('cascade');

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
		//
	}

}
