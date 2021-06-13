<?php

declare(strict_types=1);

use App\Orchid\Screens\FarmerReport\FarmerReportListScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

Route::screen('farmer/reports', FarmerReportListScreen::class)
    ->name('platform.farmer.reports');
