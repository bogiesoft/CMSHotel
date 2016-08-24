<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;

class ActivityController extends Controller
{
    //
    public function index()
    {
        return view('admin.activities.index')->with([
            'activities' => Activity::withTrashed()->orderBy('deleted_at')->get(),
            'most_popular_activity' =>$this->mostPopular(),
            'reservations' => Reservation::all()
        ]);
    }

    public function mostPopular()
    {
        return Activity::orderBy('counter', 'desc')->first();
    }

    public function store(Request $request)
    {
        $activity = new Activity();
        $activity->name = $request->name;
        $activity->text = $request->text;
        $activity->duration = $request->duration;
        $activity->price = $request->price;

        $activity->save();

        if(Input::hasFile('img')){
            $path = 'images/activities/';
            $image = Input::file('img');
            $imgName =  $activity->name . $activity->id . '.jpg';
            $image->move($path, $imgName);
            $activity->img = $imgName;
        }
        else{
            $activity->img = 'img0.jpg';
        }

        $activity->update();

        return redirect()->action('ActivityController@index');
    }

    public function update(Activity $activity, Request $request)
    {
        $activity->name = $request->name;
        $activity->text = $request->text;
        $activity->duration = $request->duration;
        $activity->price = $request->price;

        if(Input::hasFile('img')){

            if(Input::file('img')->isValid())
            {
                $path = 'images/activities/';
                $image = Input::file('img');
                $imgName =  $activity->name . $activity->id . '.jpg';
                $image->move($path, $imgName);
                $activity->img = $imgName;
            }
        }

        $activity->update();
        return redirect()->action('ActivityController@index');
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();
        return response()->json($activity);
        //return redirect()->action('RoomController@index');
    }

    public function restore(Request $request)
    {
        $activity = Activity::withTrashed()->where('id', $request->id)->first();
        $activity->restore();
        return response()->json($activity);
    }
}
