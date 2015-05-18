<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

    public function up()
    {
        Schema::create('tests', function(Blueprint $table) {
            // These columns are needed for Baum's Nested Set implementation to work.
            // Column names may be changed, but they *must* all exist and be modified
            // in the model.
            // Take a look at the model scaffold comments for details.
            // We add indexes on parent_id, lft, rgt columns by default.
            $table->increments('id');
            $table->integer('parent_id')->nullable()->index();
            $table->integer('lft')->nullable()->index();
            $table->integer('rgt')->nullable()->index();
            $table->integer('depth')->nullable();

            // Add needed columns here (f.ex: name, slug, path, etc.)
            //$table->string('name_en', 255);
            $table->string('name', 255);
            $table->string('link', 255);
            $table->string('status', 255);

            $table->timestamps();
        });

        Schema::create('orders', function ($table) {
            $table->increments('id');
            //$table->string('name');


            $table->string('global_status');
            $table->text('comment');

            $table->string('pacient');

            $table->integer('client_id')->unsigned()->nullable();
            $table->foreign('client_id')->references('id')->on('clients');

            $table->integer('doctor_id')->unsigned()->nullable();
            $table->foreign('doctor_id')->references('id')->on('users');

            $table->integer('operator_id')->unsigned()->nullable();
            $table->foreign('operator_id')->references('id')->on('users');

            $table->integer('klinik_id')->unsigned()->nullable();
            $table->foreign('klinik_id')->references('id')->on('kliniks');

            $table->integer('diag_id')->unsigned()->nullable();
            $table->foreign('diag_id')->references('id')->on('tests')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });

        Schema::create('otzivi', function ($table) {
            $table->increments('id');


            $table->string('fio');
            $table->string('phone');

            $table->text('comment');
            $table->string('status');


            $table->string('rang_qualif');
            $table->string('rang_vnimanie');
            $table->string('rang_price');
            $table->integer('order_id')->unsigned()->nullable();
            $table->foreign('order_id')->references('id')->on('orders');

            $table->integer('doctor_id')->unsigned()->nullable();
            $table->foreign('doctor_id')->references('id')->on('users');

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('client_id')->unsigned()->nullable();
            $table->foreign('client_id')->references('id')->on('clients');



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
        Schema::dropIfExists('orders');
        Schema::dropIfExists('otzivi');

    }

}
