<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Config extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function returnStringValue()
    {
        return $this->value;
    }

    public function returnFloatValue()
    {
        return floatval($this->value);
    }

    public function returnIntValue()
    {
        return intval($this->value);
    }
}
