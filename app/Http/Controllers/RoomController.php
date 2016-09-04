<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Room;
use Illuminate\Support\Facades\Input;

class RoomController extends Controller
{
    //
    public function index($sort = 'name', $order = 'asc')
    {
        if($order == 'desc')
            $toggle = 'asc';
        else
            $toggle = 'desc';


        return view('admin.rooms.index')->with([
            'rooms' => Room::withTrashed()->orderBy($sort, $order)->get(),
            'most_popular_room' => $this->mostPopular(),
            'order' => $toggle
        ]);
    }
    public function update(Room $room, Request $request)
    {
        $room->name = $request->name;
        $room->max_people = $request->people;
        $room->wifi = $request->wifi;
        $room->kitchen = $request->kitchen;
        $room->balcony = $request->balcony;
        $room->pets = $request->pets;
        $room->size = $request->size;
        $room->price = $request->price;
        $room->text = $request->text;

        if(Input::hasFile('img')){

            if(Input::file('img')->isValid())
            {
                $path = 'images/rooms/';
                $image = Input::file('img');
                $imgName =  $room->name . $room->id . '.jpg';
                $image->move($path, $imgName);
                $room->img = $imgName;
            }
        }
        $room->update();

        return redirect()->action('RoomController@index');
    }

    public function store(Request $request)
    {
        $room = new Room();

        $room->name = $request->name;
        $room->max_people = $request->people;
        $room->wifi = $request->wifi;
        $room->kitchen = $request->kitchen;
        $room->balcony = $request->balcony;
        $room->pets = $request->pets;
        $room->size = $request->size;
        $room->price = $request->price;
        $room->text = $request->text;

        $room->save();

        if(Input::hasFile('img')){
            $path = 'images/rooms/';
            $image = Input::file('img');
            $imgName =  $room->name . $room->id . '.jpg';
            $image->move($path, $imgName);
            $room->img = $imgName;
        }
        else{
            $room->img = 'img0.jpg';
        }

        $room->update();

        return redirect()->action('RoomController@index');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return response()->json($room);
        //return redirect()->action('RoomController@index');
    }

    public function restore(Request $request)
    {
        $room = Room::withTrashed()->where('id', $request->id)->first();
        $room->restore();
        return response()->json($room);
    }

    public function mostPopular()
    {
        return Room::orderBy('counter', 'desc')->first();
    }
    
}
