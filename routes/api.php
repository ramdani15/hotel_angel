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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('auth', 'UserController@login');
Route::post('register', 'UserController@register');

Route::group(['middleware' => ['jwt.verify']], function(){
	Route::get('/user', 'UserController@index');
	Route::get('/user/{id}', 'UserController@show');
	Route::put('/user/{id}', 'UserController@edit');
	Route::delete('/user/{id}', 'UserController@destroy');

	Route::get('/room', 'RoomController@index');
	Route::post('/room', 'RoomController@store');
	Route::get('/room/{id}', 'RoomController@show');
	Route::put('/room/{id}', 'RoomController@edit');
	Route::delete('/room/{id}', 'RoomController@destroy');
	Route::post('/room/{id}/booking', 'RoomController@booking');

	Route::get('/book', 'BookController@index');
	Route::post('/book/cancel-all', 'BookController@cancel_all');
	Route::get('/book/{id}', 'BookController@show');
	Route::delete('/book/{id}', 'BookController@destroy');
	Route::post('/book/{id}/cancel', 'BookController@cancel');
	Route::post('/book/{id}/payment', 'BookController@payment');

	Route::get('/payment', 'PaymentController@index');
	Route::get('/payment/{id}', 'PaymentController@show');
	Route::delete('/payment/{id}', 'PaymentController@destroy');
	Route::post('/payment/{id}/allow', 'PaymentController@allow');
	Route::post('/payment/{id}/deny', 'PaymentController@deny');

});
