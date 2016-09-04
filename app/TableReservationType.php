<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\TableReservationType
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\TableReservation[] $reservation
 * @mixin \Eloquent
 */
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
