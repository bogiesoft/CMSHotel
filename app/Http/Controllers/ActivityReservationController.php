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
            'activities' => Activity::paginate(10),
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
        $date = (new Carbon($request->date, 'Europe/Zagreb'))->addHours($time[0])->addMinutes($time[1]);
        $now = Carbon::now('Europe/Zagreb');
        if($now->addMinutes(30)->gte($date)){
            $data = [
                'error' => 'Please select time at least 30 minutes from now',
            ];

            if($request->ajax()){
                return response()->json($data);
            }
        }
        else if($date->gte((new Carbon($reservation->departure, 'Europe/Zagreb'))->setTime(0,0,0)->addHours(11)->addMinutes(31))){
            $data = [
                'error' => 'Please select time at least 30 minutes before your check-out'
            ];

            if($request->ajax()){
                return response()->json($data);
            }
        }
        else{
            $reservation->activities()->attach($activity->id,['time' => $date]);
            $reservation->price += $activity->price;
            $activity->counter += 1;

            $reservation->update();
            $activity->update();

            $data = [
                'success' => 'You have successfully booked ' . $activity->name . ' for ' . $date->toDayDateTimeString()
            ];
        }

        if($request->ajax()){
            return response()->json($data);
        }
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

    public function reservations($sort = 'name', $order='asc')
    {
        if($order == 'desc')
            $toggle = 'asc';
        else
            $toggle = 'desc';

        return view('admin.reservations.activity-orders')->with([
            'activities' => Activity::has('reservations')->orderBy($sort, $order)->get(),
            'order' => $toggle
        ]);

        //$activities = Activity::all();
        return view('admin.reservations.activity-orders')->with([
            'activities' => $activities,
            'order' => $toggle
        ]);
    }
}
