<?php

use App\Http\Resources\DataResource;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', 'Api\AuthController@register');

Route::post('login', 'Api\AuthController@login');

Route::get('me', 'Api\UserController@me')->middleware('auth:api');

Route::post('quote', 'Api\QuoteController@store')->middleware('auth:api');

Route::get('quote', 'Api\QuoteController@index')->middleware('auth:api');

// cara 1 get by
Route::get('quote/{id}', 'Api\QuoteController@show')->middleware('auth:api');

// cara 2 get by
// Route::get('quote/{quote}', 'Api\QuoteController@show')->middleware('auth:api');

Route::put('quote/{quote}', 'Api\QuoteController@update')->middleware('auth:api');

Route::delete('quote/{quote}', 'Api\QuoteController@destroy')->middleware('auth:api');

// Route::middleware('auth:api')->get('me', 'Api\UserController@me', function (Request $request) {
//     return $request->me();
//     // return new DataResource(User::all());
// });

Route::post('playstation', 'Api\PlaystationController@store')->middleware('auth:api');

Route::get('playstation', 'Api\PlaystationController@index')->middleware('auth:api');

// cara 1 get by
Route::get('playstation/{id}', 'Api\PlaystationController@show');

// cara 2 get by
// Route::get('quote/{quote}', 'Api\QuoteController@show')->middleware('auth:api');

Route::put('playstation/{quote}', 'Api\PlaystationController@update')->middleware('auth:api');

Route::delete('playstation/{quote}', 'Api\PlaystationController@destroy')->middleware('auth:api');
