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
    Route::resource('users','UserController', ['parameters' => [
        'users' => 'user'
    ]]);
});
Route::resource('table-reservation', 'TableReservationController', ['parameters' => [
    'table-reservation' => 'reservation'
]]);
Route::post('table-reservation/{reservation}/rating', 'TableReservationController@rating');
Route::post('/avatar', 'UserController@uploadAvatar');

Route::resource('reservation', 'ReservationController');
Route::post('reservation/{reservation}/rating', 'ReservationController@rating');


Route::get('activity-orders/{reservation}', 'ActivityReservationController@activities',['parameters' => [
    'activity-orders' => 'reservation'
]]);
Route::resource('activity-orders', 'ActivityReservationController', ['parameters' => [
    'activity-orders' => 'order'
]]);

//dashboard
Route::group(['middleware' => ['dashboard']], function (){
    Route::get('dashboard', 'AdminController@dashboard');
    Route::group(['middleware' => ['dashboard-users']], function (){
        Route::get('dashboard/users/{user}/upgrade', 'UserController@upgrade');
        Route::get('dashboard/users/{user}/downgrade', 'UserController@downgrade');
        Route::get('dashboard/users/{user}/ban', 'UserController@ban');
        Route::resource('dashboard/users', 'AdminController', ['parameters' =>[
            'users' => 'user'
        ]]);
        Route::get('dashboard/users', 'AdminController@users');
    });

    Route::group(['middleware' => ['manager']], function (){
        //rooms
        Route::post('dashboard/rooms/restore', 'RoomController@restore');
        Route::resource('dashboard/rooms', 'RoomController', ['parameters' =>[
            'rooms' => 'room'
        ]]);

        //meals
        Route::resource('dashboard/meals','MealController', ['parameters' =>[
            'meals' => 'meal'
        ]]);
        Route::post('dashboard/meals/restore', 'MealController@restore');
        Route::post('dashboard/meal-types', 'MealController@addMealType');
        Route::delete('dashboard/meal-types/{type}', 'MealController@destroyMealType',['parameters'=>[
            'meal-types' => 'type'
        ]]);

        //tables
        Route::post('dashboard/tables/restore', 'TableController@restore');
        Route::resource('dashboard/tables', 'TableController', ['parameters' =>[
            'tables' => 'table'
        ]]);
        Route::post('dashboard/tables/restore', 'TableController@restore');

        //drinks
        Route::resource('dashboard/drinks', 'DrinkController', ['parameters' =>[
            'drinks' => 'drink'
        ]]);
        Route::post('dashboard/drinks/restore', 'DrinkController@restore');
        Route::post('dashboard/drink-types', 'DrinkController@addDrinkType');

        //activities
        Route::post('dashboard/activities/restore', 'ActivityController@restore');
        Route::resource('dashboard/activities', 'ActivityController', ['parameters' =>[
            'activities' => 'activity'
        ]]);
    });

    Route::group(['middleware' => ['dashboard-check-in']], function (){
        Route::get('dashboard/reservations', 'StaffController@reservations');
        Route::get('dashboard/table-reservations', 'StaffController@tableReservations');
        Route::get('dashboard/activity-reservations', 'StaffController@activityReservations');
        Route::post('dashboard/reservations/{reservation}/check-in', 'StaffController@reservationCheckIn');
        Route::post('dashboard/table-reservations/{reservation}/check-in', 'StaffController@tableReservationCheckIn');
    });

});
