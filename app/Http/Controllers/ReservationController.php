<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Barryvdh\DomPDF\Facade as PDF;

class ReservationController extends Controller
{
    public function index()
    {
        return view('reservation')->with('rooms', Room::all());
    }

    public function store(Request $request)
    {

        $room = Room::find($request->room);

        $arrival = new Carbon($request->arrival, 'Europe/Zagreb');
        $departure = new Carbon($request->departure, 'Europe/Zagreb');
        $now = Carbon::now('Europe/Zagreb');

        if($now->gt($arrival->copy()->addHours(17))){
            $data = [
                'success' => false,
                'message' => 'Check-in time has passed for today'
            ];
            if($request->ajax()){
                return response()->json($data);
            }
            return redirect()->back()->withInput();
        }
        elseif ($arrival->gte($departure)){
            $data = [
                'success' => false,
                'message' => 'Please select check-out date greater than check-in date'
            ];
            if($request->ajax()){
                return response()->json($data);
            }
            return redirect()->back()->withInput();
        }

        if($this->isAvailable($arrival, $departure, $room)){

            $price = $this->generatePrice($arrival, $departure, $request->people,$room->price);

            $reservation = new Reservation();
            $reservation->name = $request->name . ' ' . $request->lastname;
            $reservation->email = $request->email;
            $reservation->user_id = Auth::user()->id;
            $reservation->arrival = $arrival;
            $reservation->departure = $departure;
            $reservation->room_id = $request->room;
            $reservation->people = $request->people;
            $reservation->request = $request->req;

            if($arrival)
            $reservation->price = $price;
            $reservation->save();

            ++$room->counter;
            $room->save();

            $data = [
                'success' => true,
                'message' => 'You have successfully booked '
                    . $room->name . ' for dates: '
                    . $arrival->addHours(16)->toDayDateTimeString() . ' - '
                    . $departure->addHours(10)->toDayDateTimeString()
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

    public function generatePrice($arrival, $departure, $people, $roomBasePrice)
    {
        //$days = $arrival->diffInDays($departure);
        $price = 0;
        $daterange = new \DatePeriod($arrival, new \DateInterval('P1D'), $departure);
        foreach ($daterange as $day){
            if($day->isWeekend())
                $price += $roomBasePrice + ($roomBasePrice * 0.1);
            else
                $price += $roomBasePrice;
        }
        $price *= $people;

        return $price;
    }

    public function generatePriceForAjax(Request $request)
    {

        $arrival = new Carbon($request->arrival, 'Europe/Zagreb');
        $departure = new Carbon($request->departure, 'Europe/Zagreb');

        $price = $this->generatePrice($arrival, $departure, $request->people, $request->price);
        return response()->json($price);
    }

    public function isAvailable($arrival, $departure, $room) //
    {
        $reservations = $room->reservations()->where([
            ['departure', '>' , $arrival],
            ['arrival', '<=' , $departure]
        ])->get();

        if($reservations->isEmpty())
            return true;
        return false;
    }

    public function rating(Reservation $reservation, Request $request)
    {
        $reservation->rating = $request->rating;
        $reservation->update();
        return redirect()->action('UserController@profile');
    }


    public function reservations($sort = 'departure', $order = 'desc')
    {
        if($order == 'desc')
            $toggle = 'asc';
        else
            $toggle = 'desc';

        return view('admin.reservations.reservations')->with([
            'reservations' => Reservation::orderBy($sort, $order)->paginate(15),
            'order' => $toggle
        ]);
    }


    public function generatePDFReceipt(Reservation $reservation)
    {
        if(Auth::user()->isUser()){
            $user = Auth::user();
            if(!$user->reservations($reservation))
                return view('errors.403');
        }
        else
            $user = $reservation->user()->first();
        $dates = new \DatePeriod(new Carbon($reservation->arrival), new \DateInterval('P1D'), new Carbon($reservation->departure));

        $data = [
            'user' => $user,
            'reservation' => $reservation,
            'dates' =>$dates,
            'activities' =>$reservation->activities()->get(),
            'meals' => $reservation->meals()->get(),
            'drinks' => $reservation->drinks()->get()
        ];
        $pdf = PDF::loadView('reservation-receipt', $data);
        return $pdf->stream('reservation-receipt');
    }

}
