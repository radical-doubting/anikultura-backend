<?php

declare(strict_types=1);

use App\Orchid\Screens\BigBrother\BigBrotherEditScreen;
use App\Orchid\Screens\BigBrother\BigBrotherListScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

// Big Brothers
Route::screen('big-brothers', BigBrotherListScreen::class)
    ->name('platform.big-brothers')
    ->middleware(['access:platform.big-brothers.read'])
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Big Brothers'), route('platform.big-brothers'));
    });

// Big Brothers > Edit Big Brother
Route::screen('big-brothers/{bigBrother}/edit', BigBrotherEditScreen::class)
    ->name('platform.big-brothers.edit')
    ->middleware(['access:platform.big-brothers.edit'])
    ->breadcrumbs(function (Trail $trail, $bigBrother) {
        return $trail
            ->parent('platform.big-brothers')
            ->push(__('Edit Big Brother'), route('platform.big-brothers.edit', $bigBrother));
    });

// Big Brothers > Enroll Big Brother
Route::screen('big-brothers/create', BigBrotherEditScreen::class)
    ->name('platform.big-brothers.create')
    ->middleware(['access:platform.big-brothers.edit'])
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.big-brothers')
            ->push(__('Enroll Big Brother'), route('platform.big-brothers.create'));
    });
