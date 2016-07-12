<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meal extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function meal_type()
    {
        return $this->belongsTo(MealType::class);
    }
}
