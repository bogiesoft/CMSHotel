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
        return view('admin.users.index')->with('users', User::all());
    }

    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->sex = $request->sex;
        $user->role_id = $request->role;
        if ($user->sex)
            $user->img = 'favatar.jpg';
        else
            $user->img = 'mavatar.jpg';
        $user->save();
        return redirect()->back();
    }

    /*
     * show user
     */
    public function show(User $user)
    {

    }

    /*
     * show edit form
     */
    public function edit(User $user)
    {
        return view('admin.users.edit')->with([
            'user' => $user,
            'roles' => Role::all()]);
    }

    public function update(Request $request, User $user)
    {

        if (Gate::denies('update', $user)) {
            abort(403);
        }

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

        $imgName = $user->name . $user->lastname . $user->id . '.jpg';
        $image->move($path, $imgName);

        $user->img = $imgName;
        $user->update();

        return redirect()->action('UserController@profile');
    }

    public function profile()
    {
        $user = \Auth::user();
        $reservations = $user->reservations()->orderBy('created_at', 'descending')->get();
        $table_reservations = $user->table_reservations()->orderBy('created_at', 'descending')->get();
        return view('user.profile')->with([
            'user'=> $user,
            'reservations' => $reservations,
            'table_reservations' => $table_reservations
        ]);
    }

}