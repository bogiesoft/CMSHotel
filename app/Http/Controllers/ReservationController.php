<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Illuminate\Support\Facades\Session;


class ReservationController extends Controller
{
    //
    public function index()
    {
        return view('admin.hotel.index')->with([
            'rooms' => Room::all(),
            'reservations' => Reservation::all()
        ]);
    }

    public function reservationPage()
    {
        return view('reservation')->with('rooms', Room::all());
    }

    public function store(Request $request)
    {
        //dd($request->req);

        $arrival = Carbon::createFromFormat('d-m-Y', $request->arrival);
        $departure = Carbon::createFromFormat('d-m-Y', $request->departure);

        $reservation = new Reservation();

        $reservation->user_id = Auth::user()->id;
        $reservation->arrival = $arrival;
        $reservation->departure = $departure;
        $reservation->room_id = $request->room;
        $reservation->people = $request->people;
        $reservation->request = $request->req;

        //$reservation->price = $request->price;

        if($this->isAvailable($arrival, $departure, $reservation->room_id)){
            Auth::user()->reservations()->save($reservation);
            $room = Room::find($request->room);
            ++$room->counter;
            $room->save();
        }
        else{
            Session::flash('flash_message', 'The room is not available for selected dates');
            return \Redirect::back()->withInput($request->all());
        }

        return redirect()->action('UserController@profile');
    }

    /*
     * returns true if available
     * returns false if not available
     */
    public function isAvailable($arrival, $departure, $room) //
    {
        $reservations = Room::find($room)->reservations;
        $arrival = new Carbon($arrival);
        $departure = new Carbon($departure);

        foreach ($reservations as $reservation) {
            $arrivalB = Carbon::createFromFormat('Y-m-d', $reservation->arrival);
            $departureB = Carbon::createFromFormat('Y-m-d', $reservation->departure);

            if($departure->between($arrivalB, $departureB))
                return false;
            elseif($arrival->between($arrivalB, $departureB))
                return false;

        }
        return true;
    }


    public function create()
    {
        
    }

    public function destroy()
    {

    }

    public function update(Reservation $reservation)
    {

    }


    public function show(Reservation $reservation)
    {

    }
    /*
     *
     * show form for editing
     */
    public function edit(Reservation $reservation)
    {

    }
}
