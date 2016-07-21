<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function room(){
        return $this->belongsTo(Room::class);
    }

    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'activity_reservation', 'reservation_id', 'activity_id');
    }

    /*
     * return true if reservation is ongoing right now // user is in the hotel

     */
    public function active()
    {
        $today = Carbon::now('Europe/London');
        $arrival = new Carbon($this->arrival, 'Europe/London');
        $departure = new Carbon($this->departure, 'Europe/London');

        if($today->between($arrival, $departure, true))
            return true;
        else
            return false;


    }
}
