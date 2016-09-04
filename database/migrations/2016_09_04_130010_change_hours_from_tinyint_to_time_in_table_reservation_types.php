<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeHoursFromTinyintToTimeInTableReservationTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('table_reservation_types', function (Blueprint $table) {
            //
            $table->dropColumn('hours');
            $table->time('duration');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('table_reservation_types', function (Blueprint $table) {
            //
            $table->dropColumn('duration');
            $table->tinyInteger('hours');
        });
    }
}
