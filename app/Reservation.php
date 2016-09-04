<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Reservation
 *
 * @property-read \App\Room $room
 * @property-read \App\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Activity[] $activities
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Meal[] $meals
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Drink[] $drinks
 * @mixin \Eloquent
 */
class Reservation extends Model
{
    
    public function room(){
        return $this->belongsTo(Room::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activities()
    {
        return $this->belongsToMany(Activity::class,
            'activity_reservation',
            'reservation_id',
            'activity_id')
            ->withPivot('id', 'time')
            ->withTimestamps();
    }

    public function meals()
    {
        return $this->belongsToMany(Meal::class,
            'meal_reservation',
            'reservation_id',
            'meal_id')
            ->withPivot('id', 'count')
            ->withTimestamps();
    }
    public function drinks()
    {
        return $this->belongsToMany(Drink::class,
            'drink_reservation',
            'reservation_id',
            'drink_id')
            ->withPivot('id', 'count')
            ->withTimestamps();
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
        return false;


    }

    public function passed()
    {
        $today = Carbon::now('Europe/Zagreb');
        if($today->gt(new Carbon($this->departure, 'Europe/Zagreb')))
            return true;
        return false;
    }

    public function getFormattedArrivalDate()
    {
        return (new Carbon($this->arrival))->hour(17)->toDayDateTimeString();
    }
    public function getFormattedDepartureDate()
    {
        return (new Carbon($this->departure))->hour(12)->toDayDateTimeString();
    }
    public function getFormattedCreatedDate()
    {
        return (new Carbon($this->created_at))->toDayDateTimeString();
    }

    public function generatePriceForRoom()
    {
        $price = 0;
        $arrival = new Carbon($this->arrival);
        $departure = new Carbon($this->departure);

        $daterange = new \DatePeriod($arrival, new \DateInterval('P1D'), $departure);
        foreach ($daterange as $day){
            if($day->isWeekend())
                $price += $this->room->price + ($this->room->price * 0.1);
            else
                $price += $this->room->price;
        }
        $price *= $this->people;

        return $price;
    }


    public function generatePriceForFoodOrders()
    {
        $total = 0;
        foreach ($this->meals()->get() as $meal){
            $total += $meal->price * $meal->pivot->count;
        }
        return $total;
    }


    public function generatePriceForActivities()
    {
        $total = 0;
        foreach ($this->activities()->get() as $activity){
            $total += $activity->price;
        }
        return $total;
    }
    public function generatePriceForDrinkOrders()
    {
        $total = 0;
        foreach ($this->meals()->get() as $drink){
            $total += $drink->price * $drink->pivot->count;
        }
        return $total;
    }
    
    public function days()
    {
        $arrival = new Carbon($this->arrival);
        $departure = new Carbon($this->departure);

        return $arrival->diffInDays($departure);
    }

    public function price()
    {
        $price =  $this->generatePriceForRoom() + $this->generatePriceForActivities() + $this->generatePriceForDrinkOrders() + $this->generatePriceForFoodOrders();
        return $price;
    }

}
