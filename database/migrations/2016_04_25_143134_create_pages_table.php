<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *Creates a partials table
     * @return void
     */
    public function up()
    {
        //
        Schema::create('partials', function(Blueprint $table){
            $table->increments('id');
            $table->string('slug');
            $table->string('name');
            $table->string('header');
            $table->text('text');
            $table->string('folder');
            $table->timestamps();

            //$table->foreign('available_to')->references('id')->on('roles');
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
        Schema::drop('partials');
    }
}
