<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * App\MealType
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Meal[] $meals
 * @mixin \Eloquent
 */
class MealType extends Model
{

    protected $table='meal_types';

    public function meals()
    {
        return $this->hasMany(Meal::class)->withTrashed();
    }
}
