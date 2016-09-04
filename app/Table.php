<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * App\Table
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\TableReservation[] $reservations
 * @mixin \Eloquent
 */
class Table extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function reservations()
    {
        return $this->hasMany(TableReservation::class);
    }

}
