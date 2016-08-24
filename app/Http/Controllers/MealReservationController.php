<?php

namespace App\Http\Controllers;

use App\Meal;
use App\MealType;
use App\Reservation;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
class MealReservationController extends Controller
{
    //
    public function index(Reservation $reservation)
    {
        if($reservation->id == null)
            return redirect()->back();

        return view('menu')->with([
            'meals' => Meal::all(),
            'types' => MealType::all(),
            'max_count' => 5,
            'reservation' => $reservation
        ]);
    }

    public function store(Request $request)
    {

        $meals = $request->checked;
        $counts = $request->count;
        $reservation = Reservation::find($request->reservation_id);

        if(!$reservation->id ||!Auth::user()->reservations()->find($reservation->id)){
            $data = [
                'message' => 'Something went wrong, please try again'
            ];
            return response()->json($data);
        }

        foreach ($meals as $meal){
            $meal = Meal::find($meal);
            $reservation->meals()->attach($meal->id, ['count' => $counts[$meal->id]]);
            $meal->counter += $counts[$meal->id];
            $reservation->price += $meal->price * $counts[$meal->id];
            $meal->update();
        }
        $reservation->update();
        $data = [
            'success' => true,
            'message' => 'You have successfully placed an order for ' . $reservation->room->name
        ];

        return response()->json($data);
    }
}
