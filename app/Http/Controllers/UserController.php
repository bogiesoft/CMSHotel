<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Gate;

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
  

    /*
     * show edit form
     */
    public function edit(User $user)
    {
        return view('admin.users.edit')->with([
            'user' => $user,
            'roles' => Role::all()]);
    }

    public function update(User $user, Request $request)
    {


        if (!$user === \Auth::user()) {
            abort(403);
        }

        if(isset($password)){
            if(Hash::check($request->old, $user->password)){
                $user->password = bcrypt($request->new);
            }
        }
        else{
            $user->name = $request->name;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->sex = $request->sex;
        }
        $user->update();

        return redirect()->action('UserController@profile');
    }

    public function uploadAvatar(Request $request, User $user)
    {
        //$user = \Auth::user();
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

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json($user);
    }

    public function downgrade(User $user)
    {
        $role = Role::where('level', '=', $user->role->level - 1)->first();
        if($role){
            $user->role()->associate($role);
            $user->update();
        }

        return redirect()->action('AdminController@users');
    }

    public function upgrade(User $user)
    {
        $role = Role::where('level', '=', $user->role->level + 1)->first();
        if($role){
            $user->role()->associate($role);
            $user->update();
        }

        return redirect()->action('AdminController@users');
    }

    public function ban(User $user)
    {
        $user->banned = true;
        $user->update();
        return redirect()->action('AdminController@users');
    }
    
}