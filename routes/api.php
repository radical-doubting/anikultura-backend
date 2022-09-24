<?php

declare(strict_types=1);

use App\Actions\Authentication\Api\LoginFarmer;
use App\Actions\Authentication\Api\LogoutFarmer;
use App\Actions\Batch\Api\RetrieveFarmerSeedAllocation;
use App\Actions\Crop\Api\RetrieveCurrentSeedStage;
use App\Actions\Crop\Api\RetrieveFarmerCrops;
use App\Actions\Crop\Api\RetrieveNextSeedStage;
use App\Actions\Farmer\Api\RetrieveFarmerLanguage;
use App\Actions\Farmer\Api\RetrieveFarmerTutorialState;
use App\Actions\Farmer\Api\UpdateFarmerLanguage;
use App\Actions\Farmer\Api\UpdateFarmerTutorialState;
use App\Actions\FarmerReport\Api\RetrieveFarmerSubmittedReports;
use App\Actions\FarmerReport\Api\SubmitFarmerReport;
use App\Actions\FarmerReport\Api\UploadImageToFarmerReport;
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
        Route::get('/tutorial', RetrieveFarmerTutorialState::class);
        Route::patch('/tutorial', UpdateFarmerTutorialState::class);
        Route::get('/language', RetrieveFarmerLanguage::class);
        Route::patch('/language', UpdateFarmerLanguage::class);
    });

    Route::group(['prefix' => 'farmer-reports', 'middleware' => 'auth:api'], function () {
        Route::post('/', SubmitFarmerReport::class);
        Route::post('/{farmerReportId}/upload', UploadImageToFarmerReport::class);
        Route::get('/{farmlandId}', RetrieveFarmerSubmittedReports::class);
    });

    Route::group(['prefix' => 'crops', 'middleware' => 'auth:api'], function () {
        Route::get('/', RetrieveFarmerCrops::class);
        Route::get('/seed-allocation', RetrieveFarmerSeedAllocation::class);
        Route::post('/next-seed-stage', RetrieveNextSeedStage::class);
        Route::post('/current-seed-stage', RetrieveCurrentSeedStage::class);
    });

    Route::group(['prefix' => 'farmlands', 'middleware' => 'auth:api'], function () {
        Route::get('/', RetrieveFarmerFarmlands::class);
    });
});
