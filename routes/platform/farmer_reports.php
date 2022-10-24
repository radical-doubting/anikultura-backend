<?php

declare(strict_types=1);

use App\Orchid\Screens\FarmerReport\FarmerReportEditScreen;
use App\Orchid\Screens\FarmerReport\FarmerReportListScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

// Farmer Reports
Route::screen('farmer/reports', FarmerReportListScreen::class)
    ->name('platform.farmer-reports')
    ->middleware(['access:platform.farmer-reports.read'])
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Farmer Reports'), route('platform.farmer-reports'));
    });

// Farmer Reports > Edit Farmer Report
Route::screen('farmer-reports/{farmerReport}/edit', FarmerReportEditScreen::class)
    ->name('platform.farmer-reports.edit')
    ->middleware(['access:platform.farmer-reports.edit'])
    ->breadcrumbs(function (Trail $trail, $farmerReport) {
        return $trail
            ->parent('platform.farmer-reports')
            ->push(__('Edit Farmer Report'), route('platform.farmer-reports.edit', $farmerReport));
    });
