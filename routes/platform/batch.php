<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;
use App\Orchid\Screens\Batch\BatchListScreen;
use App\Orchid\Screens\Batch\BatchEditScreen;


// Batch
Route::screen('batches', BatchListScreen::class)
    ->name('platform.batches')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Batch'), route('platform.batches'));
    });


// Batch > Edit Batch
Route::screen('batch-{batch}/edit', BatchEditScreen::class)
    ->name('platform.batches.edit')
    ->breadcrumbs(function (Trail $trail, $batches) {
        return $trail
            ->parent('platform.batches')
            ->push(__('Edit Batch'), route('platform.batches.edit', $batches));
    });

// Batch > Create Batch
Route::screen('batches/create', BatchEditScreen::class)
    ->name('platform.batches.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.batches')
            ->push(__('Create Batch'), route('platform.batches.create'));
    });


