<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Drink extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function drink_type()
    {
        return $this->belongsTo(DrinkType::class);
    }

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class,
            'drink_reservation',
            'drink_id',
            'reservation_id')
            ->withPivot('id', 'count')
            ->withTimestamps();
    }

    public function getTotalDrinkIncome()
    {
        $income = 0;
        foreach ($this->reservations()->get() as $reservation){
            $income += $reservation->pivot->count * $this->price;
        }

        return $income;
    }
}
