<?php

declare(strict_types=1);

use App\Orchid\Screens\Farmland\FarmlandEditScreen;
use App\Orchid\Screens\Farmland\FarmlandListScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

// Farmlands
Route::screen('farmlands', FarmlandListScreen::class)
    ->name('platform.farmlands')
    ->middleware(['access:platform.farmlands.read'])
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Farmland'), route('platform.farmlands'));
    });

// Farmland > Edit Farmland
Route::screen('farmlands/{farmland}/edit', FarmlandEditScreen::class)
    ->name('platform.farmlands.edit')
    ->middleware(['access:platform.farmlands.edit'])
    ->breadcrumbs(function (Trail $trail, $farmland) {
        return $trail
            ->parent('platform.farmlands')
            ->push(__('Edit Farmland'), route('platform.farmlands.edit', $farmland));
    });

// Farmland > Create Farmland
Route::screen('enroll/farmer/farmland', FarmlandEditScreen::class)
    ->name('platform.farmlands.create')
    ->middleware(['access:platform.farmlands.edit'])
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.farmlands')
            ->push(__('Create Farmland'), route('platform.farmlands.create'));
    });
