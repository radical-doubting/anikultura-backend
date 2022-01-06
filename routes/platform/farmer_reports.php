<?php

declare(strict_types=1);

use App\Orchid\Screens\FarmerReport\FarmerReportEditScreen;
use App\Orchid\Screens\FarmerReport\FarmerReportListScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

// Farmer Reports
Route::screen('farmer/reports', FarmerReportListScreen::class)
    ->name('platform.farmer-reports')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Farmer Reports'), route('platform.farmer-reports'));
    });

// Farmer Reports > Edit Farmer Report
Route::screen('farmer-reports/{farmerReport}/edit', FarmerReportEditScreen::class)
    ->name('platform.farmer-reports.edit')
    ->breadcrumbs(function (Trail $trail, $farmerReport) {
        return $trail
            ->parent('platform.farmer-reports')
            ->push(__('Edit Farmer Report'), route('platform.farmer-reports.edit', $farmerReport));
    });

// Farmer Reports > Create Farmer Report
Route::screen('farmer-reports/create', FarmerReportEditScreen::class)
    ->name('platform.farmer-reports.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.farmer-reports')
            ->push(__('Create Farmer Report'), route('platform.farmer-reports.create'));
    });
