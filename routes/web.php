<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('confirm', function () {
    return view('confirm.confirm');
})->name('confirm.view');
Route::get('/users/{accessToken}/register', 'Admin\SendMailController@confirmRegistation')->name('register.confirm');
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['admin', 'auto_logout']], function () {
    Route::get('/', 'HomeController@index')->name('home.index');

    Route::resource('/users', 'UserController');
    Route::post('/users/{accessToken}/updateActive', 'UserController@updateActive')->name('user.updateActive');
    Route::post('/users/{accessToken}/updateRole', 'UserController@updateRole')->name('user.updateRole');
    
    Route::resource('/cities', 'CityController');

    Route::resource('/cinemas', 'CinemaController');
    Route::get('/cinemas/{cinema_id}/city', 'CinemaController@getListCinemabyCityId')->name('cinemas.showListByCityId');
    
    Route::resource('/films', 'FilmController');
    Route::put('/films/{id}/updateActive', 'FilmController@updateActive')->name('films.updateActive');
    Route::post("/films/importFilms", "FilmController@importExcel")->name("films.import");

    Route::resource('/seats', 'SeatController');

    Route::resource('/schedules', 'ScheduleController');
    Route::put('/schedules/{date}/{room_id}/updateSchedule', 'ScheduleController@updateSchedule')->name('schedules.updateSchedule');
    Route::get('/films/{id}/getData', 'FilmController@getData')->name('films.getData');

    Route::resource('/rooms', 'RoomController');
    Route::get('/rooms/{cinema_id}/listRoom', "RoomController@listRoomByCinemaID");

    Route::get('/bookings', 'BookingController@index')->name('bookings.index');
    Route::get('/bookings/export', 'BookingController@export')->name('bookings.export');

    
});

Route::group(['namespace' => 'User'], function () {
    Route::get('/', 'HomeFEController@index')->name("homepage");
    
    Route::resource("/contact", "ContactFEController");
  
    Route::resource("/reviews", "ReviewFEController");

    Route::resource("/videos", "FilmFEController");

    Route::get("/films/{id_schedule}/booking", "BookTicketController@booking")->name("films.booking");
    Route::get("/payment/booking", "BookTicketController@payment")->name("films.payment");
    Route::post("/films/{user_id}/{id_schedule}/booking", "BookTicketController@createBooking")->name("films.createBooking");
    Route::post("/films/booking/store", "BookTicketController@store")->name("films.booking.store");

    Route::get("/cities/available", "CityController@showCityHaveCinema")->name("cities.available");

    Route::get("/cinemas", "CinemaController@index")->name("cinemasFE.index");

    Route::get("/schedules", "ScheduleController@index")->name("scheduleFE.index");

    Route::resource("/comments", "CommentController");

    Route::post ('/account/stripe_card_token', 'BookTicketController@striperCard')->name('striper.card');
});
