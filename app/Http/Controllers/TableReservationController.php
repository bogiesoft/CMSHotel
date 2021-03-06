<?php

namespace App\Http\Controllers;

use App\Drink;
use App\Meal;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Table;
use App\TableReservation;
use App\TableReservationType;
use Carbon\Carbon;
use App\Config;
class TableReservationController extends Controller
{
    //
    public function index()
    {
        return view('diner')->with([
            'meals' => Meal::all(),
            'drinks' => Drink::all(),
            'types' => TableReservationType::all(),
            'tables' => Table::all()
        ]);
    }

    public function store(Request $request)
    {

        $tables = $this->getPossibleTables($request->people);
        $time = explode(':', $request->time);

        $arrival = (new Carbon($request->date, 'Europe/Zagreb'))->addHours($time[0])->addMinutes($time[1]);
        $departure = $arrival->copy()->addHour(TableReservationType::find($request->type)->duration);
        $now = Carbon::now('Europe/Zagreb');

        if ($now->addMinutes(30)->gte($arrival)) {
            $data = [
                'success' => false,
                'message' => 'Please select time at least 30 minutes from now'
            ];

            if ($request->ajax()) {
                return response()->json($data);
            }
            return redirect()->back()->withInput();

        }

        //  Check staff for each possible table
        foreach ($tables as $table) {
            if ($this->isAvailable($table, $arrival, $departure)) {

                $reservation = new TableReservation();
                $reservation->user_id = \Auth::user()->id;
                $reservation->name = $request->name;
                $reservation->table_id = $table->id;
                $reservation->people = $request->people;
                $reservation->reservation_type_id = $request->type;
                $reservation->arrival = $arrival;
                $reservation->departure = $departure;
                $reservation->save();

                $data = [
                    'success' => true,
                    'message' => 'You have successfully booked a table for '
                        . $arrival->toDayDateTimeString()
                ];

                if ($request->ajax()) {
                    return response()->json($data);
                }
                return redirect()->back()->withInput();

            }
        }


        $data = [
            'success' => false,
            'message' => 'No tables available for selected date or time',
        ];
        if ($request->ajax()) {
            return response()->json($data);
        }
        return redirect()->back()->withInput();

    }

    //  Checks all staff for table
    //  Returns true if the table is available for given period
    //  Returns false if table is booked
    public function isAvailable($table, $arrival, $departure)
    {
        //return true;


        $reservations = $table->reservations()->where([
            ['departure', '>=', $arrival],
            ['arrival', '<=', $departure]
        ])->get();

        if ($reservations->isEmpty())
            return true;
        return false;

    }

    //Get possible tables
    //Returns tables number of people < > people + 3 (max 3 unused seats per table)
    public function getPossibleTables($people)
    {
        $max_empty_seats = floatval(Config::where('config', '=', 'max_empty_seats')->first()->value);
        return Table::whereBetween('people', [$people, $people + $max_empty_seats])
            ->orderBy('people', 'asc')->get();

    }

    public function create()
    {
        return view('table-reservation')->with('types', TableReservationType::all());
    }

    public function rating(TableReservation $reservation, Request $request)
    {
        $reservation->rating = $request->rating;
        $reservation->update();
        return redirect()->action('UserController@profile');
    }

    public function reservations($sort = 'departure', $order = 'desc')
    {
        if ($order == 'desc')
            $toggle = 'asc';
        else
            $toggle = 'desc';

        return view('admin.reservations.table-reservations')->with([
            'reservations' => TableReservation::orderBy($sort, $order)->paginate(15),
            'order' => $toggle
        ]);
    }
}

