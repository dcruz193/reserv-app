<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::apiResources([
    'v1/hotels' => 'Api\V1\HotelController',
    'v1/reservations' => 'Api\V1\ReservationController'
]);
Route::get('v1/getReservations/{email}','Api\V1\ReservationController@getReservations');