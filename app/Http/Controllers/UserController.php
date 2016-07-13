<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{

    public function index()
    {
        return view('admin.users.index')->with('users',User::all());
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->sex = $request->sex;
        $user->role_id = $request->role;
        if($user->sex)
            $user->img = 'favatar.jpg';
        else
            $user->img = 'mavatar.jpg';
        $user->save();
        
        return redirect()->action('UserController@index');
    }

    /*
     * show user
     */
    public function show(User $user)
    {
        return view();
    }

    /*
     * show edit form
     */
    public function edit(User $user)
    {
        return view('admin.users.edit')->with([
            'user'      =>  $user,
            'roles'     =>  Role::all()]);
    }
    public function update(Request $request, User $user)
    {
        //$email = $request->email    . '@cmshotel';

        //$user->role_id = $request->role;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->lastname = $request->lastname;
        $user->sex = $request->sex;

        $user->update();

        return redirect()->action('UserController@profile');
    }

    public function uploadAvatar()
    {
        $user = \Auth::user();
        $path = 'images/users/avatars';
        $image = Input::file('img');
        //$imgName =  $image->getClientOriginalName();

        $imgName = $user->name . $user->lastname . $user->id . '.jpg' ;
        $image->move($path, $imgName);

        $user->img = $imgName;
        $user->update();

        return redirect()->action('UserController@profile');
    }
    public function profile()
    {
        return view('user.profile')->with([
            'user'=> \Auth::user(),
            'reservations' => \Auth::user()->reservations,
            'table_reservations' => \Auth::user()->table_reservations
        ]);
    }

    


}
