<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Activity;
class ActivityReservationController extends Controller
{
    //
    public function index()
    {
        return view('user.in-room-orders')->with([
            'reservations' => $this->activeReservationsForUser(\Auth::user()),
            'activities' => Activity::all()
        ]);
    }

    public function activeReservationsForUser($user)
    {
        $active = [];
        foreach ($user->reservations()->get() as $reservation){
            if($reservation->active())
                array_push($active, $reservation);
        }
        return $active;
    }
}
