<?php

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

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'farmer', 'as' => 'api.', 'namespace' => 'App\Http\Controllers\Api'], function () {
    Route::post('/login', 'AuthenticationController@login')->name('login');
    Route::post('/logout', 'AuthenticationController@logout')->name('logout');
});
