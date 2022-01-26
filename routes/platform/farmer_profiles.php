<?php

declare(strict_types=1);

use App\Orchid\Screens\Farmer\FarmerEditScreen;
use App\Orchid\Screens\Farmer\FarmerListScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

// Farmers
Route::screen('farmers', FarmerListScreen::class)
    ->name('platform.farmers')
    ->middleware(['access:platform.farmers.read'])
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Farmers'), route('platform.farmers'));
    });

// Farmers > Edit Farmer
Route::screen('farmers/{farmerProfile}/edit', FarmerEditScreen::class)
    ->name('platform.farmers.edit')
    ->middleware(['access:platform.farmers.edit'])
    ->breadcrumbs(function (Trail $trail, $farmerProfile) {
        return $trail
            ->parent('platform.farmers')
            ->push(__('Edit Farmer Profile'), route('platform.farmers.edit', $farmerProfile));
    });

// Farmers > Enroll Farmer
Route::screen('farmers/create', FarmerEditScreen::class)
    ->name('platform.farmers.create')
    ->middleware(['access:platform.farmers.edit'])
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.farmers')
            ->push(__('Enroll Farmer'), route('platform.farmers.create'));
    });
