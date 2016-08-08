<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TableReservation extends Model
{
    //
    protected $table = 'table_reservations';

    public function reservation_type()
    {
        return $this->belongsTo(TableReservationType::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getFormattedArrivalDate()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->arrival)->toDayDateTimeString();
    }

    public function passed()
    {
        $today = Carbon::now('Europe/London');
        if($today->gt(Carbon::createFromFormat('Y-m-d H:i:s', $this->departure,'Europe/London')))
            return true;
        return false;
    }

}
