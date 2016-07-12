<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TableReservationType extends Model
{
    //
    protected $table = 'table_reservation_types';

    public function reservation()
    {
        return $this->hasMany(TableReservation::class);
    }

    public function hours()
    {
        return $this->hours;
    }
}
