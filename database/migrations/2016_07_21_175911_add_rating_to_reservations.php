<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRatingToReservations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            //
            $table->tinyInteger('rating');
        });

        Schema::table('table_reservations', function (Blueprint $table) {
            //
            $table->tinyInteger('rating');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            //
            $table->dropColumn('rating');
        });
        Schema::table('table_reservations', function (Blueprint $table) {
            //
            $table->dropColumn('rating');
        });
    }
}
