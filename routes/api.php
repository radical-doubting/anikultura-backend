<?php

use App\Actions\Authentication\LoginFarmer;
use App\Actions\Authentication\LogoutFarmer;
use App\Actions\Batch\RetrieveFarmerSeedAllocation;
use App\Actions\Crop\RetrieveFarmerCrops;
use App\Actions\Crop\RetrieveFarmerSeedStage;
use App\Actions\Crop\RetrieveNextSeedStage;
use App\Actions\Farmer\UpdateFarmerTutorialState;
use App\Actions\FarmerReport\RetrieveFarmerSubmittedReports;
use App\Actions\FarmerReport\SubmitFarmerReport;
use App\Actions\Farmland\RetrieveFarmerFarmlands;
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

Route::group(['as' => 'api.'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/login', LoginFarmer::class)->name('login');
        Route::post('/logout', LogoutFarmer::class)->name('logout')->middleware('auth:api');
    });

    Route::group(['prefix' => 'farmers', 'middleware' => 'auth:api'], function () {
        Route::patch('/tutorial', UpdateFarmerTutorialState::class);
    });

    Route::group(['prefix' => 'farmer-reports', 'middleware' => 'auth:api'], function () {
        Route::post('/', SubmitFarmerReport::class);
        Route::get('/', RetrieveFarmerSubmittedReports::class);
    });

    Route::group(['prefix' => 'crops', 'middleware' => 'auth:api'], function () {
        Route::get('/', RetrieveFarmerCrops::class);
        Route::get('/seed-allocation', RetrieveFarmerSeedAllocation::class);
        Route::post('/next-seed-stage', RetrieveNextSeedStage::class);
        Route::post('/current-seed-stage', RetrieveFarmerSeedStage::class);
    });

    Route::group(['prefix' => 'farmlands', 'middleware' => 'auth:api'], function () {
        Route::get('/', RetrieveFarmerFarmlands::class);
    });
});
