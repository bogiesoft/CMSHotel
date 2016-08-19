<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            //
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('fk_user')->unsigned();
            $table->foreign('fk_user')->references('id')->on('users');
            $table->integer('fk_room')->lenght(10)->unsigned();
            $table->foreign('fk_room')->lenght(10)->references('id')->on('rooms');
            $table->date('arrival');
            $table->date('departure');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('staff');
    }
}
