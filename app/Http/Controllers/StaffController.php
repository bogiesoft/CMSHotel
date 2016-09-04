<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Reservation;
use App\TableReservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class StaffController extends Controller
{
    //
    public function reservations()
    {
        $now = Carbon::now('Europe/Zagreb')->setTime(0,0,0);
        $tomorrow = $now->copy()->addDay();


        return view('staff.reservations')->with([
            'todays' => Reservation::where([
                ['arrival', '>=' , $now],
                ['arrival', '<' , $tomorrow]
            ])->orderBy('name')->paginate(10),
            'yesterday' => Reservation::where([
                ['arrival', '<' , $now],
                ['arrival', '>=' , $now->copy()->subDay()]
            ])->orderBy('name')->get(),
            'tomorrow' => Reservation::where([
                ['arrival', '>=' , $tomorrow],
                ['arrival', '<' , $tomorrow->copy()->addDay()]
            ])->orderBy('name')->get()
        ]);
    }

    public function tableReservations()
    {
        $now = Carbon::now()->setTime(0,0,0);
        $tomorrow = $now->copy()->addDay();
        return view('staff.table-reservations')->with([
            'todays' => TableReservation::where([
                ['arrival', '>' , $now],
                ['arrival', '<' , $tomorrow]
            ])->orderBy('name')->paginate(10),
            'yesterday' => TableReservation::where([
                ['arrival', '<' , $now],
                ['arrival', '>=' , $now->copy()->subDay()]
            ])->orderBy('name')->get(),
            'tomorrow' => TableReservation::where([
                ['arrival', '>=' , $tomorrow],
                ['arrival', '<' , $tomorrow->copy()->addDay()]
            ])->orderBy('name')->get()
        ]);
    }

    public function activityReservations()
    {
        $now = Carbon::now()->setTime(0,0,0);
        $activities = Activity::all();


        return view('staff.activity-reservations')->with([
            'activities' => $activities,
            'now' => $now
        ]);
    }

    public function reservationCheckIn(Reservation $reservation)
    {
        $reservation->checked_in = true;
        $reservation->update();
        return redirect()->action('StaffController@reservations');
    }

    public function tableReservationCheckIn(TableReservation $reservation)
    {
        $reservation->checked_in = true;
        $reservation->update();
        return redirect()->action('StaffController@tableReservations');
    }
}
