<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('table_id')->unsigned();
            $table->foreign('table_id')->references('id')->on('tables');
            $table->string('name');
            $table->integer('reservation_type_id')->unsigned();
            $table->foreign('reservation_type_id')->references('id')->on('table_reservation_types');
            $table->dateTime('arrival');
            $table->dateTime('departure');
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
        Schema::drop('table_reservations');
    }
}
