<?php

namespace App\Http\Controllers;

use App\Meal;
use App\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Activity;

class ActivityReservationController extends Controller
{
    //
    public function index()
    {
        $reservations = $this->activeReservationsForUser(\Auth::user());
        if(count($reservations) > 1){
            return view('user.in-room-orders')->with([
                'norating' => true,
                'reservations' => $reservations
            ]);
        }
        else{
            return redirect()->action('ActivityReservationController@activities', $reservations[0]);
        }
    }

    public function activities(Reservation $reservation)
    {
        return view('user.activities')->with([
            'reservation' => $reservation,
            'activities' => Activity::all(),
            'meals' =>Meal::all()
        ]);
    }

    public function activityForm(Reservation $reservation, Activity $activity)
    {
        return view('user.activity-reservation-form')->with([
            'activity' => $activity,
            'reservation' => $reservation
        ]);
    }
    
    public function activeReservationsForUser($user)
    {
        $active = [];
        foreach ($user->reservations()->get() as $reservation){
            if($reservation->active() && $reservation->checked_in)
                array_push($active, $reservation);
        }
        return $active;
    }

    public function store(Request $request)
    {
        $reservation = Reservation::find($request->reservation_id);
        $activity = Activity::find($request->activity_id);

        $time = explode(':', $request->time);
        $date = (new Carbon($request->date, 'Europe/London'))->addHours($time[0])->addMinutes($time[1]);

        $reservation->activities()->attach($activity->id,['time' => $date]);
        $reservation->price += $activity->price;
        $activity->counter += 1;

        $reservation->update();
        $activity->update();

        return view('user.order-finish')->with([
            'reservation' =>  $reservation,
            'activity' => Activity::find($request->activity_id),
            'date' => $date->toDayDateTimeString()
        ]);
    }

    public function getAllOrders($activities)
    {
        $orders = [];
        $now = Carbon::now();
        foreach ($activities as $activity) {
            foreach ($activity->reservations()->get() as $order) {
                if(Carbon::create($order->pivot->date)->gt($now))
                    array_push($orders, $order);
            }
        }
    }

}
