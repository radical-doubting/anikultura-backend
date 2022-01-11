<?php

use App\Actions\Authentication\LoginFarmer;
use App\Actions\Authentication\LogoutFarmer;
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

Route::group(['prefix' => 'farmer', 'as' => 'api.'], function () {
    Route::post('/login', LoginFarmer::class)->name('login');
    Route::post('/logout', LogoutFarmer::class)->name('logout');
});
