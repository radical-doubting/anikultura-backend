<?php

declare(strict_types=1);

use App\Orchid\Screens\Batch\BatchEditScreen;
use App\Orchid\Screens\Batch\BatchListScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

// Batches
Route::screen('batches', BatchListScreen::class)
    ->name('platform.batches')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Batches'), route('platform.batches'));
    });

// Batches > Edit Batch
Route::screen('batches/{batch}/edit', BatchEditScreen::class)
    ->name('platform.batches.edit')
    ->breadcrumbs(function (Trail $trail, $batch) {
        return $trail
            ->parent('platform.batches')
            ->push(__('Edit Batch'), route('platform.batches.edit', $batch));
    });

// Batch > Create Batch
Route::screen('batches/create', BatchEditScreen::class)
    ->name('platform.batches.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.batches')
            ->push(__('Create Batch'), route('platform.batches.create'));
    });
