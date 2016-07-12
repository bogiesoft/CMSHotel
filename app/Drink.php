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
}
