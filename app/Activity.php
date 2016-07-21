<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //
    protected $table = 'activities';

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'activity_reservation', 'activity_id', 'reservation_id');
    }
}
