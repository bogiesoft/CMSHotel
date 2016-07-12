<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname' , 'sex', 'email', 'password',
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
}
