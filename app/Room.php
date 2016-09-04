<?php

namespace App;

use Carbon\Carbon;
use Faker\Provider\DateTime;
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

            $income += $reservation->generatePriceForRoom();
        }

        return $income;
    }

    public function getTotalRoomIncome()
    {
        $income = 0;
        foreach ($this->reservations()->get() as $reservation){
            $income += $reservation->price();
        }

        return $income;
    }

    public function getRating()
    {
        $rating = 0;
        $ratings = $this->reservations()->get();
        $count = 0;
        foreach ($ratings as $r){
            if(!$r->rating == 0)
                $count++;
            $rating += $r->rating;
        }
        if($rating == 0)
            return 0;
        return $rating / $count;
    }

    public function priceForToday()
    {
        if(Carbon::now('Europe/Zagreb')->addDays(2)->isWeekend())
            return $this->price += $this->price * 0.1;
        else
            return $this->price;
    }

    public function priceForThisDay(Carbon $day)
    {
        if($day->isWeekend())
            return $this->price + $this->price*0.1;
        return $this->price;
    }

}
