<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
