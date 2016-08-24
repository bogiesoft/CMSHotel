<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function getRoomIncome()
    {
        $income = 0;
        foreach ($this->reservations()->get() as $reservation){
            $income += $reservation->people  * $reservation->room->price;
        }

        return $income;
    }

    public function getTotalRoomIncome()
    {
        $income = 0;
        foreach ($this->reservations()->get() as $reservation){
            $income += $reservation->price;
        }

        return $income;
    }

    public function getRating()
    {
        $rating = 0;
        $ratings = $this->reservations()->get();
        foreach ($ratings as $r){
            $rating += $r->rating;
        }
        if($rating == 0)
            return 0;
        return $rating / count($ratings);
    }

}
