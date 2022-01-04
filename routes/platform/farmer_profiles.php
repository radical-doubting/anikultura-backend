<?php

declare(strict_types=1);

use App\Orchid\Screens\Farmer\FarmerEditScreen;
use App\Orchid\Screens\Farmer\FarmerListScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

// Platform > System > Farmer Profile > Enroll
Route::screen('enroll/farmer', FarmerEditScreen::class)
    ->name('platform.farmer.profile.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.farmer.profile.view.all')
            ->push(__('Enroll Farmer'), route('platform.farmer.profile.create'));
    });

// Platform > System > Farmer Profile > View
Route::screen('view/farmer', FarmerListScreen::class)
    ->name('platform.farmer.profile.view.all')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Farmer Profiles'), route('platform.farmer.profile.view.all'));
    });

// Platform > System > Farmer Profile > Edit
Route::screen('edit/farmer/{farmer_profile}', FarmerEditScreen::class)
    ->name('platform.farmer.profile.edit')
    ->breadcrumbs(function (Trail $trail, $farmer_profile) {
        return $trail
            ->parent('platform.farmer.profile.view.all')
            ->push(__('Edit Farmer Profile'), route('platform.farmer.profile.edit', $farmer_profile));
    });
