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

Route::post('authenticate', 'AuthenticateController@authenticate');
Route::resource('users', 'UserController');

// Auth routes
Route::group(['middleware' => ['jwt.auth']], function () {
    Route::resource('pets', 'PetController');
});
