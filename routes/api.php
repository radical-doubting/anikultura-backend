<?php

declare(strict_types=1);

use App\Actions\Authentication\Api\LoginFarmer;
use App\Actions\Authentication\Api\LogoutFarmer;
use App\Actions\Batch\Api\RetrieveFarmerSeedAllocation;
use App\Actions\Crop\Api\RetrieveCurrentSeedStage;
use App\Actions\Crop\Api\RetrieveFarmerCrops;
use App\Actions\Crop\Api\RetrieveNextSeedStage;
use App\Actions\User\Farmer\Api\RetrieveFarmerLanguage;
use App\Actions\User\Farmer\Api\RetrieveFarmerTutorialState;
use App\Actions\User\Farmer\Api\UpdateFarmerLanguage;
use App\Actions\User\Farmer\Api\UpdateFarmerTutorialState;
use App\Actions\FarmerReport\Api\RetrieveFarmerSubmittedReports;
use App\Actions\FarmerReport\Api\SubmitFarmerReport;
use App\Actions\Farmland\Api\RetrieveFarmerFarmlands;
use Illuminate\Support\Facades\Route;

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

Route::group(['as' => 'api.'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/login', LoginFarmer::class)->name('login');
        Route::post('/logout', LogoutFarmer::class)->name('logout')->middleware('auth:api');
    });

    Route::group(['prefix' => 'farmers', 'middleware' => 'auth:api'], function () {
        Route::get('/tutorial', RetrieveFarmerTutorialState::class)->name('tutorial');
        Route::patch('/tutorial', UpdateFarmerTutorialState::class)->name('tutorial.update');
        Route::get('/language', RetrieveFarmerLanguage::class)->name('language');
        Route::patch('/language', UpdateFarmerLanguage::class)->name('language.update');
    });

    Route::group(['prefix' => 'farmer-reports', 'middleware' => 'auth:api'], function () {
        Route::post('/', SubmitFarmerReport::class)->name('reports.submit');
        Route::get('/{farmlandId}', RetrieveFarmerSubmittedReports::class)->name('reports');
    });

    Route::group(['prefix' => 'crops', 'middleware' => 'auth:api'], function () {
        Route::get('/', RetrieveFarmerCrops::class)->name('crops');
        Route::get('/seed-allocation', RetrieveFarmerSeedAllocation::class)->name('seeds.allocation');
        Route::post('/next-seed-stage', RetrieveNextSeedStage::class)->name('seeds.next-stage');
        Route::post('/current-seed-stage', RetrieveCurrentSeedStage::class)->name('seeds.current-stage');
    });

    Route::group(['prefix' => 'farmlands', 'middleware' => 'auth:api'], function () {
        Route::get('/', RetrieveFarmerFarmlands::class)->name('farmlands');
    });
});
