<?php

declare(strict_types=1);

use App\Orchid\Screens\Crop\CropEditScreen;
use App\Orchid\Screens\Crop\CropListScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

//Crops

Route::screen('crops', CropListScreen::class)
    ->name('platform.crops')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Crops'), route('platform.crops'));
    });

//Crops > Edit
 
Route::screen('crops/{crop}/edit', CropEditScreen::class)
    ->name('platform.crops.edit')
    ->breadcrumbs(function (Trail $trail, $crop) {
        return $trail
            ->parent('platform.crops')
            ->push(__('Edit Crops'), route('platform.crops.edit', $crop));
    });
  
//Crops > Create Crops
 
Route::screen('crops/create', CropEditScreen::class)
    ->name('platform.crops.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.crops')
            ->push(__('Create Crops'), route('platform.crops.create'));
    });