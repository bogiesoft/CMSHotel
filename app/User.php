<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname' , 'sex', 'email', 'password', 'img'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function table_reservations()
    {
        return $this->hasMany(TableReservation::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isAdmin()
    {
        if(\Auth::user()->role->role == 'admin')
            return true;
        else
            return false;
    }

    public function isStaff()
    {
        if(\Auth::user()->role->role == 'staff')
            return true;
        else
            return false;
    }
    public function isManager()
    {
        if(\Auth::user()->role->role == 'manager')
            return true;
        else
            return false;
    }

    public function hasDashboard()
    {
        if(\Auth::user()->role->role == 'admin')
            return true;
        else
            return false;
    }

    public function hasActiveReservation()
    {
        $td = Carbon::now();
        foreach ($this->reservations()->get() as $reservation){
            if($reservation->active())
                return true;
        }
        return false;
    }

}
