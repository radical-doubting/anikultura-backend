<?php

use App\Actions\Site\Region\CreateRegion;
use App\Actions\Site\Region\DeleteRegion;
use App\Models\Site\Region;
use Illuminate\Support\Facades\Log;

beforeEach(function () {
    Log::spy();
});

it('logs create messages from loggable models', function () {
    CreateRegion::run(
        new Region(),
        [
            'name' => 'National Capital Region',
            'short_name' => 'NCR',
        ]
    );

    Log::shouldHaveReceived('info')
        ->with('Region created')
        ->once();
});

it('logs update messages from loggable models', function () {
    $existingRegion = Region::create([
        'name' => 'National Capital Region',
        'short_name' => 'NCR',
    ]);

    CreateRegion::run(
        $existingRegion,
        [
            'name' => 'A New Region',
            'short_name' => 'ANR',
        ]
    );

    Log::shouldHaveReceived('info')
        ->with('Region updated')
        ->once();
});

it('logs delete messages from loggable models', function () {
    $existingRegion = Region::create([
        'name' => 'National Capital Region',
        'short_name' => 'NCR',
    ]);

    DeleteRegion::run($existingRegion);

    Log::shouldHaveReceived('info')
        ->with('Region deleted')
        ->once();
});
