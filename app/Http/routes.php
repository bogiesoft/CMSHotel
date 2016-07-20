<?php

Route::auth();
Route::get('/', function () {
    return view('home');
});
Route::get('/about', 'PagesController@about');
Route::get('/rooms', function(){
    $rooms = App\Room::all();
    return view('rooms')->with(['rooms' => $rooms]);
});
Route::get('/diner', 'TableReservationController@index');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile', 'UserController@profile');
});
Route::resource('users','UserController', ['parameters' => [
    'users' => 'user'
]]);
Route::resource('table-reservation', 'TableReservationController', ['parameters' => [
    'table-reservation' => 'reservation'
]]);
Route::post('/avatar', 'UserController@uploadAvatar');
Route::resource('reservation', 'ReservationController');


//dashboard
Route::group(['middleware' => ['admin']], function (){
    Route::get('dashboard', 'AdminController@dashboard');
    Route::resource('dashboard/rooms', 'RoomController', ['parameters' =>[
        'rooms' => 'room'
    ]]);
    Route::resource('dashboard/meals','MealController', ['parameters' =>[
        'meals' => 'meal'
    ]]);
    Route::post('dashboard/meal-types', 'MealController@addMealType');
    Route::delete('dashboard/meal-types/{type}', 'MealController@destroyMealType',['parameters'=>[
        'meal-types' => 'type'
    ]]);
    
    Route::resource('dashboard/tables', 'TableController', ['parameters' =>[
        'tables' => 'table'
    ]]);
    Route::resource('dashboard/drinks', 'DrinkController', ['parameters' =>[
        'drinks' => 'drink'
    ]]);

});

Route::get('test', 'ReservationController@test');
