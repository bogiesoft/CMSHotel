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


    public function store(Request $request)
    {
        //$arrival = Carbon::createFromFormat('d-m-Y', $request->arrival, 'Europe/London');
        //$departure = Carbon::createFromFormat('d-m-Y', $request->departure, 'Europe/London');

        $room = Room::find($request->room);

        $arrival = new Carbon($request->arrival, 'Europe/London');
        $departure = new Carbon($request->departure, 'Europe/London');

        if($this->isAvailable($arrival, $departure, $room)){
            $reservation = new Reservation();
            
            $reservation->name = $request->name . ' ' . $request->lastname;
            $reservation->email = $request->email;
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

            $data = [
                'success' => true,
                'message' => 'You have successfully booked '
                    . $room->name . ' for dates: '
                    . $arrival->toFormattedDateString() . ' - '
                    . $departure->toFormattedDateString()
            ];

            return response()->json($data);
        }
        else{
            $data = [
                'success' => false,
                'message' => $room->name .' is not available for selected dates'
            ];

            return response()->json($data);
        }
    }

    public function isAvailable($arrival, $departure, $room) //
    {
        foreach ($room->reservations as $reservation) {

            $arrivalB = new Carbon($reservation->arrival, 'Europe/London');
            $departureB =  new Carbon($reservation->departure, 'Europe/London');



            //$arrivalB = Carbon::createFromFormat('Y-m-d', $reservation->arrival, 'Europe/London' );
            //$departureB = Carbon::createFromFormat('Y-m-d', $reservation->departure, 'Europe/London');

            if($departure->between($arrivalB, $departureB, true))
                return false;

            if($arrival->between($arrivalB, $departureB, true))
                return false;

        }
        return true;
    }

}
