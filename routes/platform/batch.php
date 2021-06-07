<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;
use App\Orchid\Screens\Batch\BatchListScreen;
use App\Orchid\Screens\Batch\BatchEditScreen;


// Batch
Route::screen('batch', BatchListScreen::class)
    ->name('platform.batch')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Batch'), route('platform.batch'));
    });


// Batch > Edit Batch
Route::screen('batch-{batch}/edit', BatchEditScreen::class)
    ->name('platform.batch.edit')
    ->breadcrumbs(function (Trail $trail, $batches) {
        return $trail
            ->parent('platform.batch')
            ->push(__('Edit Batch'), route('platform.batch.edit', $batches));
    });

// Batch > Create Batch
Route::screen('batch/create', BatchEditScreen::class)
    ->name('platform.batch.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.batch')
            ->push(__('Create Batch'), route('platform.batch.create'));
    });


