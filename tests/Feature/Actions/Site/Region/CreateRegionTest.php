<?php

use App\Actions\Site\Region\CreateRegion;
use App\Models\Site\Region;

it('should add a site region', function () {
    $regionData = [
        'name' => 'National Capital Region',
        'short_name' => 'NCR',
    ];

    /**
     * @var Region
     */
    $createdRegion = CreateRegion::run(
        new Region(),
        $regionData
    );

    expect($createdRegion)->toMatchArray(
        $regionData
    );

    expect($createdRegion->id)->toBeTruthy();
    expect($createdRegion->slug)->toBe('ncr');
    expect($createdRegion->created_at)->toBeTruthy();
    expect($createdRegion->updated_at)->toBeTruthy();

    $this->assertDatabaseCount('regions', 1);
    $this->assertDatabaseHas('regions', $regionData);
});

it('should update a site region', function () {
    $existingRegion = Region::create([
        'name' => 'National Capital Region',
        'short_name' => 'NCR',
    ]);

    $regionData = [
        'name' => 'A New Region',
        'short_name' => 'ANR',
    ];

    /**
     * @var Region
     */
    $updatedRegion = CreateRegion::run(
        $existingRegion,
        $regionData
    );

    expect($updatedRegion)->toMatchArray(
        $regionData
    );

    expect($updatedRegion->id)->toBe($existingRegion->id);
    expect($updatedRegion->slug)->toBe('anr');
    expect($updatedRegion->created_at)->toBeTruthy();
    expect($updatedRegion->updated_at)->toBeTruthy();

    $this->assertDatabaseCount('regions', 1);
    $this->assertDatabaseHas('regions', $regionData);
});
