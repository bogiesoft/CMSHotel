<?php

namespace App\Http\Controllers;

use App\Meal;
use App\MealType;
use App\Reservation;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Drink;
class MealReservationController extends Controller
{
    //
    public function index(Reservation $reservation)
    {
        if($reservation->id == null)
            return redirect()->back();

        return view('menu')->with([
            'meals' => Meal::all(),
            'drinks' => Drink::all(),
            'types' => MealType::all(),
            'reservation' => $reservation
        ]);
    }

    public function store(Request $request)
    {
        $reservation = Reservation::find($request->reservation_id);

        if(!$reservation->id ||!Auth::user()->reservations()->find($reservation->id)){
            $data = [
                'message' => 'Something went wrong, please try again'
            ];
            return response()->json($data);
        }

        $meals = $request->meals_checked;
        $counts = $request->meals_count;

        if($meals){
            foreach ($meals as $mealID){
                $meal = Meal::find($mealID);
                $pivotRecord = $reservation->meals()->find($meal->id);
                if($pivotRecord){
                    $reservation->meals()->updateExistingPivot($meal->id,
                        [
                            'count' => $pivotRecord->pivot->count += $counts[$meal->id]
                        ]);
                }
                else
                    $reservation->meals()->attach($meal->id, ['count' => $counts[$meal->id]]);

                $meal->counter += $counts[$meal->id];
                $reservation->price += $meal->price * $counts[$meal->id];
                $meal->update();
            }
        }

        $drinks = $request->drinks_checked;
        $counts = $request->drinks_count;

        if($drinks){
            foreach ($drinks as $drinkID){
                $drink = Drink::find($drinkID);
                $pivotRecord = $reservation->drinks()->find($drink->id);
                if($pivotRecord){
                    $reservation->drinks()->updateExistingPivot($drink->id,
                        [
                            'count' => $pivotRecord->pivot->count += $counts[$drink->id]
                        ]);
                }
                else
                    $reservation->drinks()->attach($drink->id, ['count' => $counts[$drink->id]]);

                $drink->counter += $counts[$drink->id];
                $reservation->price += $drink->price * $counts[$drink->id];
                $drink->update();
            }
        }

        if(!$meals && !$drinks){
            $data = [
                'message' => 'Please select at least one meal or drink '
            ];

            return response()->json($data);
        }
        else{
            $reservation->update();
            $data = [
                'success' => true,
                'message' => 'You have successfully placed an order for ' . $reservation->room->name
            ];

            return response()->json($data);
        }
    }

    public function reservations($sort = 'name', $order='asc')
    {
        if($order == 'desc')
            $toggle = 'asc';
        else
            $toggle = 'desc';

        return view('admin.reservations.food-orders')->with([
            'meals' => Meal::has('reservations')->orderBy($sort, $order)->get(),
            'order' => $toggle
        ]);
    }
}
