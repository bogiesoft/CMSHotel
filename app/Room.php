<?php

namespace App;

use App\Config;
use Carbon\Carbon;
use Faker\Provider\DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Room
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Reservation[] $reservations
 * @mixin \Eloquent
 */
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
        $priceBoost = floatval(Config::where('config', '=', 'weekend_room_price')->first()->value);

        if(Carbon::now('Europe/Zagreb')->addDays(2)->isWeekend())
            return $this->price += $this->price * $priceBoost;
        else
            return $this->price;
    }

    public function priceForThisDay(Carbon $day, $priceBoost)
    {

        if($day->isWeekend())
            return $this->price + $this->price * $priceBoost;
        return $this->price;
    }

}
