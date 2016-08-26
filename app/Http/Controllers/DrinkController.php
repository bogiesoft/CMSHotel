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
            'drinks' => Drink::withTrashed()->orderBy('deleted_at')->get(),
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

    public function restore(Request $request)
    {
        $drink = Drink::withTrashed()->where('id', $request->id)->first();
        $drink->restore();
        return response()->json($drink);
    }

    public function destroyDrinkType(DrinkType $type, Request $request)
    {

        if(isset($request->clear_drinks)){
            $this->changeAllOfType($type->id,$request->new_type);
            DrinkType::destroy($type->id);
            return redirect()->action('DrinkController@index');
        }
        if($type->drinks()->get()->isEmpty()){
            $type = DrinkType::destroy($type->id);
        }
        else{
            $type['error']= 'Some drinks are of this type';
            return response()->json($type);
        }
        return response()->json($type);

    }

    public function changeAllOfType($oldType,$newType)
    {
        Drink::where('drink_type_id', '=', $oldType)->update(['drink_type_id' => $newType]);
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
