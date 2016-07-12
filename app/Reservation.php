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

    /*
     * return true if reservation is in  the future/is active
     * return false if reservation has ended/is not active
     */
    public function active()
    {
        $today = Carbon::now();
        if($today->gt(new Carbon($this->departure)))
            return false;
        else
            return true;


    }
}
