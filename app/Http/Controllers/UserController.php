<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

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

        $data = '';
        if (!$user === \Auth::user()) {
            abort(403);
        }
        if(isset($request->password)){
            if(Hash::check($request->old, $user->password)){
                $user->password = bcrypt($request->new);
            }
            else{
                $data = [
                    'error' => 'Please enter your old password'
                ];
                return response()->json($data);
            }

            $data['password-success'] = 'You successfully changed your password';
        }
        elseif (isset($request->edit)){
            $user->name = $request->name;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->sex = $request->sex;

            $data = [
                'edit-success' => 'You successfully changed your information',
                'name' => $user->name,
                'lastname' => $user->lastname
            ];
        }
        $user->update();

        return response()->json($data);


        //return redirect()->action('UserController@profile');
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

        //room
        $future_reservation = $user->reservations()
            ->where('departure','>=', (Carbon::now()->setTime(17,15,0)))->orderBy('arrival', 'asc')
            ->get();
        $past_reservations = $user->reservations()
            ->where('departure','<', (Carbon::now()->setTime(17,15,0)))->orderBy('arrival', 'asc')
            ->get();

        //table
        $future_table_reservations = $user->table_reservations()
            ->where('departure','>=', (Carbon::now()->addMinutes(10)))
            ->orderBy('arrival', 'asc')
            ->get();
        $past_table_reservations = $user->table_reservations()
            ->where('departure','<', Carbon::now())
            ->orderBy('arrival', 'asc')->get();


        return view('user.profile')->with([
            'user'=> $user,
            'past_reservations' => $past_reservations,
            'future_reservations' => $future_reservation,
            'past_table_reservations' => $past_table_reservations,
            'future_table_reservations' => $future_table_reservations
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