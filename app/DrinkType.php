<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * App\DrinkType
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Drink[] $drinks
 * @mixin \Eloquent
 */
class DrinkType extends Model
{
    //
    protected $table='drink_types';

    public function drinks()
    {
        return $this->hasMany(Drink::class)->withTrashed();
    }
}
