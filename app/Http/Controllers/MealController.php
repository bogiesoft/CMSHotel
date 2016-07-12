<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Meal;
use App\MealType;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response;

class MealController extends Controller
{
    //
    public function index()
    {
        return view('admin.meals.index')->with([
            'meals'=> Meal::all(),
            'types'  =>  MealType::all()
        ]);

        //'trashed' => Meal::onlyTrashed()->get()
    }

    public function store(Request $request)
    {
        $meal = new Meal;
        $meal->name = $request->name;
        $meal->text = $request->text;
        $meal->price = $request->price;
        $meal->meal_type_id = $request->meal_type;

        $meal->save();

        $path = 'images/meals/';
        $image = Input::file('img');
        $imgName =  $meal->name . $meal->id . '.jpg';
        $image->move($path, $imgName);
        $meal->img = $imgName;
        $meal->update();

        return redirect()->action('MealController@index');
    }

    public function show(Meal $meal)
    {
        return view('admin.meals.show')->with('meal', $meal);
    }


    public function destroy(Meal $meal)
    {
        $meal = Meal::destroy($meal->id);
        return response()->json($meal);
    }

    public function update(Meal $meal, Request $request)
    {
        $meal->name = $request->name;
        $meal->text = $request->text;
        $meal->price = $request->price;
        $meal->meal_type_id = $request->meal_type;

        $path = 'images/meals/';
        $image = Input::file('img');
        $imgName =  $meal->name . $meal->id . '.jpg';
        $image->move($path, $imgName);
        $meal->img = $imgName;
        $meal->update();

        return redirect()->action('MealController@index');
    }
}
