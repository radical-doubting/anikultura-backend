<?php

use App\Facades\AnikulturaFacade as Anikultura;
use App\Providers\PlatformFoundationServiceProvider;

it('registers platform dashboards when headless mode is disabled', function () {
    Anikultura::shouldReceive('isHeadless')
        ->andReturn(false)
        ->twice();

    $platformFoundationServiceProvider = Mockery::mock(PlatformFoundationServiceProvider::class)
        ->makePartial();
    $platformFoundationServiceProvider
        ->shouldReceive('bootOrchidPlatform')
        ->once();

    $platformFoundationServiceProvider
        ->shouldReceive('registerOrchidPlatform')
        ->once();

    $platformFoundationServiceProvider->boot();
    $platformFoundationServiceProvider->register();
});

it('does not register platform dashboards when headless mode is enabled', function () {
    Anikultura::shouldReceive('isHeadless')
        ->andReturn(true)
        ->twice();

    $platformFoundationServiceProvider = Mockery::mock(PlatformFoundationServiceProvider::class)
        ->makePartial();
    $platformFoundationServiceProvider
        ->shouldNotReceive('bootOrchidPlatform');

    $platformFoundationServiceProvider
        ->shouldNotReceive('registerOrchidPlatform');

    $platformFoundationServiceProvider->boot();
    $platformFoundationServiceProvider->register();
});
