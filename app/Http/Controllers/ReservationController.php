<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;


class ReservationController extends Controller
{

    public function test()
    {
        return view('reservation-info');
    }
    public function index()
    {
        return view('reservation')->with('rooms', Room::all());
    }

    public function reservationPage()
    {
        return view('reservation')->with('rooms', Room::all());
    }

    public function store(Request $request)
    {
        $arrival = Carbon::createFromFormat('d-m-Y', $request->arrival);
        $departure = Carbon::createFromFormat('d-m-Y', $request->departure);

        $reservation = new Reservation();
        $room = Room::find($request->room);
        if($this->isAvailable($arrival, $departure, $request->room)){
            $reservation->user_id = Auth::user()->id;
            $reservation->arrival = $arrival;
            $reservation->departure = $departure;
            $reservation->room_id = $request->room;
            $reservation->people = $request->people;
            $reservation->request = $request->req;
            $reservation->price = $reservation->people * $reservation->room->price;

            $reservation->save();
            ++$room->counter;

            $room->save();
            $message = 'success';
            return response()->json($message);
        }
        else{
            $message = $room->name .' is not available for selected dates';
            return response()->json($message);
        }
    }

    public function isAvailable($arrival, $departure, $room) //
    {
        $reservations = Room::find($room)->reservations;
        $arrival = new Carbon($arrival);
        $departure = new Carbon($departure);

        foreach ($reservations as $reservation) {
            $arrivalB = Carbon::createFromFormat('Y-m-d', $reservation->arrival);
            $departureB = Carbon::createFromFormat('Y-m-d', $reservation->departure);

            if($arrivalB == $arrival || $departureB == $departure)
                return false;
            if($departure->between($arrivalB, $departureB))
                return false;
            elseif($arrival->between($arrivalB, $departureB))
                return false;

        }
        return true;
    }

}
