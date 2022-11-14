<?php

use App\Facades\AnikulturaFacade as Anikultura;
use App\Providers\InsightServiceProvider;

it('registers insight observers when insights are enabled', function () {
    Anikultura::shouldReceive('isInsightsEnabled')
        ->andReturn(true)
        ->once();

    $insightServiceProvider = Mockery::mock(InsightServiceProvider::class)->makePartial();
    $insightServiceProvider
        ->shouldReceive('registerInsightObservers')
        ->once();

    $insightServiceProvider->boot();
});

it('does not register insight observers when insights are disabled', function () {
    Anikultura::shouldReceive('isInsightsEnabled')
        ->andReturn(false)
        ->once();

    $insightServiceProvider = Mockery::mock(InsightServiceProvider::class)->makePartial();
    $insightServiceProvider
        ->shouldNotReceive('registerInsightObservers');

    $insightServiceProvider->boot();
});
