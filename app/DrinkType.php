<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrinkType extends Model
{
    //
    protected $table='drink_types';

    public function drinks()
    {
        return $this->hasMany(Drink::class);
    }
}
