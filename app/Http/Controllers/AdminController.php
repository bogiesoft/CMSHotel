<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller
{
    //


    public function index()
    {

    }

    public function users()
    {
        return view('admin.users.index')->with([
            'users' => User::where('role_id', '=', '2')->orderBy('lastname')->get(),
            'staff' => User::where('role_id', '=', '3')->orderBy('lastname')->get(),
            'managers' => User::where('role_id', '=', '4')->orderBy('lastname')->get(),
            'admins' => User::where('role_id', '=', '1')->orderBy('lastname')->get(),
            'roles' => Role::where('id', '!=', '2')->get()
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
