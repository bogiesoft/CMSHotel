<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Drink;
use App\DrinkType;

class DrinkController extends Controller
{
    //

    public function index()
    {
        return view('admin.drinks.index')->with([
            'drinks' => Drink::all(),
            'types' => DrinkType::all()
        ]);
    }

    public function store(Request $request)
    {
        $drink = new Drink();

        $drink->name= $request->name;
        $drink->text = $request->text;
        $drink->price = $request->price;
        $drink->drink_type_id = $request->drink_type;

        $drink->save();

        return redirect()->action('DrinkController@index');
    }

    public function update(Drink $drink, Request $request)
    {
        $drink->name= $request->name;
        $drink->text = $request->text;
        $drink->price = $request->price;
        $drink->drink_type_id = $request->drink_type;

        $drink->update();
        return redirect()->action('DrinkController@index');
    }

    public function destroy(Drink $drink)
    {
        $drink = Drink::destroy($drink->id);
        return response()->json($drink);
    }

    public function addDrinkType(Request $request)
    {
        $types = explode(',', trim(ucwords($request->types)));
        $newtype= null;
        foreach ($types as $type){
            $newtype = new DrinkType();
            $newtype->name = trim(ucfirst($type));
            $newtype->save();
        }

        return redirect()->action('DrinkController@index');
    }
}
