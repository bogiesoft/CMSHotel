<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Meal;
use App\MealType;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response;
use App\Reservation;
class MealController extends Controller
{

    public function index($sort = 'name', $order = 'asc')
    {
        if($order == 'desc')
            $toggle = 'asc';
        else
            $toggle = 'desc';

        return view('admin.meals.index')->with([
            'meals'=> Meal::withTrashed()->orderBy($sort, $order)->paginate(10),
            'types'  =>  MealType::all(),
            'most_popular_meal' => $this->mostPopular(),
            'order' => $toggle
        ]);

    }

    public function store(Request $request)
    {
        $meal = new Meal;
        $meal->name = $request->name;
        $meal->text = $request->text;
        $meal->price = $request->price;
        $meal->meal_type_id = $request->meal_type;

        $meal->save();

        if(Input::hasFile('img')){

            if(Input::file('img')->isValid())
            {
                $path = 'images/meals/';
                $image = Input::file('img');
                $imgName =  $meal->name . $meal->id . '.jpg';
                $image->move($path, $imgName);
            }
        }
        else
            $imgName = 'img0.jpg';

        $meal->img = $imgName;
        $meal->update();

        return redirect()->action('MealController@index');
    }

    public function show(Meal $meal)
    {
        return view('admin.meals.show')->with('meal', $meal);
    }

    public function update(Meal $meal, Request $request)
    {
        $meal->name = $request->name;
        $meal->text = $request->text;
        $meal->price = $request->price;
        $meal->meal_type_id = $request->meal_type;

        if(Input::hasFile('img')){

            if(Input::file('img')->isValid())
            {
                $path = 'images/meals/';
                $image = Input::file('img');
                $imgName =  $meal->name . $meal->id . '.jpg';
                $image->move($path, $imgName);
                $meal->img = $imgName;
            }
        }

        $meal->update();

        return redirect()->action('MealController@index');
    }

    public function addMealType(Request $request)
    {
        $types = explode(',', trim(ucwords($request->types)));
        $newtype= null;
        foreach ($types as $type){
            $newtype = new MealType();
            $newtype->name = trim(ucfirst($type));
            $newtype->save();
        }

        return redirect()->action('MealController@index');
    }

    public function destroyMealType(MealType $type, Request $request)
    {

        if(isset($request->clear_meals)){
            $this->changeAllOfType($type->id,$request->new_type);
            MealType::destroy($type->id);
            return redirect()->action('MealController@index');
        }
        if($type->meals()->get()->isEmpty()){
            $type = MealType::destroy($type->id);
        }
        else{
            $type['error']= 'Some meals are of this type';
            return response()->json($type);
        }
        return response()->json($type);

    }

    public function changeAllOfType($oldType,$newType)
    {
        Meal::withTrashed()->where('meal_type_id', '=', $oldType)->update(['meal_type_id' => $newType]);
    }

    public function destroy(Meal $meal)
    {
        $meal = Meal::destroy($meal->id);
        return response()->json($meal);
    }

    public function restore(Request $request)
    {
        $meal = Meal::withTrashed()->where('id', $request->id)->first();
        $meal->restore();
        return response()->json($meal);
    }

    public function mostPopular()
    {
        return Meal::orderBy('counter', 'desc')->first();
    }

}
