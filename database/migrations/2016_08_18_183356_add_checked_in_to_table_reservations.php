<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCheckedInToTableReservations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('table_reservations', function (Blueprint $table) {
            //
            $table->boolean('checked_in');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('table_reservations', function (Blueprint $table) {
            //
            $table->dropColumn('checked_in');
        });
    }
}
