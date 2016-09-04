<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Meal;
use App\Reservation;
use App\Role;
use App\Room;
use App\Table;
use App\TableReservation;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    
    public function update(Request $request, User $user)
    {

        if(isset($password)){
            if(Hash::check($request->old, $user->password)){
                if($request->new == $request->new2)
                    $user->password = bcrypt($request->new);
            }
        }
        else{
            $user->name = $request->name;
            $user->lastname = $request->lastname;
            $user->email = $request->email . '@cmshote.com';
            $user->sex = $request->sex;
        }
        $user->update();


        return route('/dashboard');
    }
    public function users()
    {
        return view('admin.users.index')->with([
            'staff' => User::where('role_id', '=', '3')->get(),
            'managers' => User::where('role_id', '=', '4')->get(),
            'admins' => User::where('role_id', '=', '1')->get(),
            'roles' => Role::where('id', '!=', '2')->get()
        ]);
    }

    public function onlyUsers($sort = 'lastname', $order = 'asc')
    {
        if($order == 'desc')
            $toggle = 'asc';
        else
            $toggle = 'desc';


        return view('admin.users.users')->with([
            'users' => User::where('role_id', '=', '2')->orderBy($sort, $order)->paginate(10),
            'order' => $toggle
        ]);
    }

    public function destroy(Request $request, User $user)
    {
        $user->delete();
        return redirect()->action('AdminController@index');
    }
    public function dashboard()
    {
        return view('layouts.dashboard');
    }


    public function store(Request $request)
    {
        if($request->sex == '1')
            $img = 'favatar.jpg';
        else
            $img = 'mavatar.jpg';

        $domain = '@cmshotel.com';
        $user = new User();
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->sex = $request->sex;
        $user->email = trim($request->email) . $domain;
        $user->role_id = $request->role;
        $user->password = bcrypt($request->password);
        $user->img = $img;

        $user->save();

        return redirect()->action('AdminController@index');
    }
    
    
}
