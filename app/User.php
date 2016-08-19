<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name', 'lastname' , 'sex', 'email', 'password', 'img', 'role'
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

    public function isUser()
    {
        if($this->role->role == 'user')
            return true;
        else
            return false;
    }
    public function isAdmin()
    {
        if($this->role->role == 'admin')
            return true;
        else
            return false;
    }

    public function isStaff()
    {
        if($this->role->role == 'staff')
            return true;
        else
            return false;
    }
    public function isManager()
    {
        if($this->role->role == 'manager')
            return true;
        else
            return false;
    }

    public function hasDashboard()
    {
        if($this->isUser())
            return false;
        return true;
    }

    //true if reservations is currently happening and the user checked-in
    public function hasActiveReservation()
    {
        $td = Carbon::now();
        foreach ($this->reservations()->get() as $reservation){
            if($reservation->active() && $reservation->checked_in)
                return true;
        }
        return false;
    }

    public function getFormattedLastLogin()
    {
        $date = new Carbon($this->last_login);
        return $date->diffForHumans();
    }

}
