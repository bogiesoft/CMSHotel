<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Meal
 *
 * @property-read \App\MealType $meal_type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Reservation[] $reservations
 * @mixin \Eloquent
 */
class Meal extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function meal_type()
    {
        return $this->belongsTo(MealType::class);
    }

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class,
            'meal_reservation',
            'meal_id',
            'reservation_id')
            ->withPivot('id', 'count')
            ->withTimestamps();
    }

    public function getTotalMealIncome()
    {
        $income = 0;
        foreach ($this->reservations()->get() as $reservation){
            $income += $reservation->pivot->count * $this->price;
        }

        return $income;
    }
}
