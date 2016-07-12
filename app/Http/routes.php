<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('home');
});
Route::auth();
Route::get('/about', 'PagesController@about');

Route::get('/rooms', function(){
    $rooms = App\Room::all();
    
    return view('rooms')->with(['rooms' => $rooms]);
});


Route::get('/profile', 'UserController@profile');

Route::resource('user','UserController');
Route::get('/diner', 'TableReservationController@index');

Route::resource('table-reservation', 'TableReservationController', ['parameters' => [
    'table-reservation' => 'reservation'
]]);


Route::post('/avatar', 'UserController@uploadAvatar');

Route::resource('reservation', 'ReservationController');
Route::get('/reserve', 'ReservationController@reservationPage');


//dashboard
Route::get('dashboard', 'AdminController@dashboard');
Route::resource('dashboard/rooms', 'RoomController', ['parameters' =>[
    'rooms' => 'room'
]]);
Route::resource('dashboard/meals','MealController', ['parameters' =>[
    'meals' => 'meal'
]]);
Route::resource('dashboard/tables', 'TableController', ['parameters' =>[
    'tables' => 'table'
]]);
Route::resource('dashboard/drinks', 'DrinkController', ['parameters' =>[
    'drinks' => 'drink'
]]);

Route::get('user/create/staff', 'UserController@createStaff');
Route::get('user/create/manager', 'UserController@createManager');
Route::get('user/create/admin', 'UserController@createAdmin');
