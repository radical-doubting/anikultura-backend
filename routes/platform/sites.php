<?php

declare(strict_types=1);

use App\Orchid\Screens\Site\Region\RegionEditScreen;
use App\Orchid\Screens\Site\Region\RegionListScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

// Sites > Regions > Edit Region
Route::screen('sites/regions/{region}/edit', RegionEditScreen::class)
    ->name('platform.sites.regions.edit')
    ->breadcrumbs(function (Trail $trail, $region) {
        return $trail
            ->parent('platform.sites.regions')
            ->push(__('Edit Region'), route('platform.sites.regions.edit', $region));
    });

// Sites > Regions > Create Region
Route::screen('sites/regions/create', RegionEditScreen::class)
    ->name('platform.sites.regions.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.sites.regions')
            ->push(__('Create Region'), route('platform.sites.regions.create'));
    });

// Sites > Regions
Route::screen('sites/regions', RegionListScreen::class)
    ->name('platform.sites.regions')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Regions'), route('platform.sites.regions'));
    });
