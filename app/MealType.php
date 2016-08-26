<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class MealType extends Model
{

    protected $table='meal_types';

    public function meals()
    {
        return $this->hasMany(Meal::class)->withTrashed();
    }
}
