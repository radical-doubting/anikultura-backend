<?php

declare(strict_types=1);

use App\Orchid\Screens\Farmland\FarmlandEditScreen;
use App\Orchid\Screens\Farmland\FarmlandListScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

// Platform > System > Farmland > Create
Route::screen('enroll/farmer/farmland', FarmlandEditScreen::class)
    ->name('platform.farmer.farmland.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.farmer.farmland.view.all')
            ->push(__("Enroll Farmer's Farmland"), route('platform.farmer.farmland.create'));
    });

// Platform > System > Farmland > View
Route::screen('view/all/farmland', FarmlandListScreen::class)
    ->name('platform.farmer.farmland.view.all')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__("Farmer's Farmland"), route('platform.farmer.farmland.view.all'));
    });

// Platform > System > Farmland > Edit
Route::screen('farmer/farmland/edit/{farmland}', FarmlandEditScreen::class)
    ->name('platform.farmer.farmland.edit')
    ->breadcrumbs(function (Trail $trail, $farmland) {
        return $trail
            ->parent('platform.farmer.farmland.view.all')
            ->push(__("Edit Farmer's Farmland"), route('platform.farmer.farmland.edit', $farmland));
    });
