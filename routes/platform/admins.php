<?php

declare(strict_types=1);

use App\Orchid\Screens\User\Admin\AdminEditScreen;
use App\Orchid\Screens\User\Admin\AdminListScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

// Administrators
Route::screen('admins', AdminListScreen::class)
    ->name('platform.admins')
    ->middleware(['access:platform.admins.read'])
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Administrators'), route('platform.admins'));
    });

// Administrators > Edit Administrator
Route::screen('admins/{admin}/edit', AdminEditScreen::class)
    ->name('platform.admins.edit')
    ->middleware(['access:platform.admins.edit'])
    ->breadcrumbs(function (Trail $trail, $admin) {
        return $trail
            ->parent('platform.admins')
            ->push(__('Edit Administrator'), route('platform.admins.edit', $admin));
    });

// Administrators > Enroll Administrator
Route::screen('admins/create', AdminEditScreen::class)
    ->name('platform.admins.create')
    ->middleware(['access:platform.admins.edit'])
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.admins')
            ->push(__('Enroll Administrator'), route('platform.admins.create'));
    });
