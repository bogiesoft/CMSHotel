<?php

Route::auth();
Route::get('/', function () {
    if(Auth::check()){
        Auth::user()->last_login = Carbon\Carbon::now('Europe/Zagreb');
        Auth::user()->update();
    }
    return view('home')->with([
        'room' => \App\Room::orderBy('price', 'asc')->first(),
        'meal' => \App\Meal::orderBy('counter', 'desc')->first(),
        'activity' => \App\Activity::orderBy('counter', 'desc')->first(),
    ]);
});
Route::get('/about', 'PagesController@about');
Route::get('/rooms', function(){
    $rooms = App\Room::paginate(6);
    return view('rooms')->with(['rooms' => $rooms]);
});
Route::get('/activities', function(){
    $activities = App\Activity::paginate(6);
    return view('activities')->with(['activities' => $activities]);
});
Route::get('/restaurant', 'TableReservationController@index');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile', 'UserController@profile');
    Route::post('users/{user}/avatar', 'UserController@uploadAvatar');
    Route::resource('users','UserController', ['parameters' => [
        'users' => 'user'
    ]]);

    Route::get('/{reservation}/meal-order', 'MealReservationController@index');
    Route::resource('/meal-order', 'MealReservationController');
});
Route::resource('table-reservation', 'TableReservationController', ['parameters' => [
    'table-reservation' => 'reservation'
]]);
Route::post('table-reservation/{reservation}/rating', 'TableReservationController@rating');

Route::get('/reservation/generate-price', 'ReservationController@generatePriceForAjax');
Route::resource('reservation', 'ReservationController');
Route::post('reservation/{reservation}/rating', 'ReservationController@rating');


Route::get('activity-orders/{reservation}', 'ActivityReservationController@activities',['parameters' => [
    'activity-orders' => 'reservation'
]]);
Route::get('activity-orders/{reservation}/{activity}', 'ActivityReservationController@activityForm',['parameters' => [
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

        Route::get('dashboard/users/users/{sort?}/{order?}', 'AdminController@onlyUsers');
        Route::resource('dashboard/users', 'AdminController', ['parameters' =>[
            'users' => 'user'
        ]]);
        Route::get('dashboard/users', 'AdminController@users');
    }); 
    //rooms
    Route::get('dashboard/rooms/reservations/{sort?}/{order?}', 'ReservationController@reservations');
    Route::post('dashboard/rooms/restore', 'RoomController@restore');

    Route::get('dashboard/rooms/{sort?}/{order?}', 'RoomController@index');
    Route::resource('dashboard/rooms', 'RoomController', ['parameters' =>[
        'rooms' => 'room'
    ]]);

    Route::group(['middleware' => ['manager']], function (){


        //meals
        Route::get('dashboard/meals/reservations/{sort?}/{order?}', 'MealReservationController@reservations');
        Route::resource('dashboard/meals','MealController', ['parameters' =>[
            'meals' => 'meal'
        ]]);
        Route::post('dashboard/meals/restore', 'MealController@restore');
        Route::post('dashboard/meal-types', 'MealController@addMealType');
        Route::delete('dashboard/meal-types/{type}', 'MealController@destroyMealType',['parameters'=>[
            'meal-types' => 'type'
        ]]);

        //tables
        Route::get('dashboard/tables/reservations/{sort?}/{order?}', 'TableReservationController@reservations');
        Route::post('dashboard/tables/restore', 'TableController@restore');

        Route::get('dashboard/tables/{sort?}/{order?}', 'TableController@index');
        Route::resource('dashboard/tables', 'TableController', ['parameters' =>[
            'tables' => 'table'
        ]]);

        //drinks
        Route::get('dashboard/drinks/reservations/{sort?}/{order?}', 'DrinkController@reservations');
        Route::get('dashboard/drinks/{sort?}/{order?}', 'DrinkController@index');
        Route::resource('dashboard/drinks', 'DrinkController', ['parameters' =>[
            'drinks' => 'drink'
        ]]);
        Route::post('dashboard/drinks/restore', 'DrinkController@restore');
        Route::post('dashboard/drink-types', 'DrinkController@addDrinkType');
        Route::delete('dashboard/drink-types/{type}', 'DrinkController@destroyDrinkType',['parameters'=>[
            'drink-types' => 'type'
        ]]);

        //activities
        Route::get('dashboard/activities/reservations/{sort?}/{order?}', 'ActivityReservationController@reservations');

        Route::post('dashboard/activities/restore', 'ActivityController@restore');
        Route::get('dashboard/activities/{sort?}/{order?}', 'ActivityController@index');
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

/*
 *
Route::get('/pdf', function(){
    $pdf = App::make('dompdf.wrapper');
    $header = 'CMSHotel';
    $html = ;
    //dd(getcwd() . '\home');

    $pdf->loadHTML($html);
    return $pdf->stream();
});

 */
Route::get('/receipt/{reservation}',array('as'=>'pdf','uses'=>'ReservationController@generatePDFReceipt'));