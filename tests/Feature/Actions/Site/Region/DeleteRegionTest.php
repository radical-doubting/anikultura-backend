<?php

use App\Actions\Site\Region\DeleteRegion;
use App\Models\Site\Region;

it('deletes an existing site region', function () {
    $regionData = [
        'name' => 'National Capital Region',
        'short_name' => 'NCR',
    ];

    $existingRegion = Region::create($regionData);

    /**
     * @var bool
     */
    $isDeleted = DeleteRegion::run($existingRegion);

    expect($isDeleted)->toBe(true);

    $this->assertDatabaseCount('regions', 0);
    $this->assertDatabaseMissing('regions', $regionData);
});

it('should not delete a non-existent site region', function () {
    /**
     * @var bool
     */
    $isDeleted = DeleteRegion::run(new Region());

    expect($isDeleted)->toBe(false);
});
