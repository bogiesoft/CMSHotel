<?php

namespace App\Http\Controllers;

use App\Reservation;
use View;
use App\Http\Requests;
use App\Room;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\URL;
use App\User;
use Carbon\Carbon;
class PagesController extends Controller
{
    //

    /**
     * @param $slug
     * @return View
     */
    public function index($slug){

        if(view()->exists($slug)){
            return view($slug);
        }
        else {
            return redirect()->back();
        }

    }

    public function reset()
    {
        return view('auth.passwords.reset');
    }

    public function home(){

        return view('home');
    }

    public function about(){
        return view('about');
    }
    

    public function rooms()
    {
        $rooms = Room::all();
        return view('rooms')->with('rooms', $rooms);
    }

    public function profile()
    {
        $user = Auth::user();
        return view('profile', ['users' => $user, 'staff' => $user->reservations]);
    }

}
