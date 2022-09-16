<?php

use App\Actions\Site\Province\DeleteProvince;
use App\Models\Site\Province;
use App\Models\Site\Region;

beforeEach(function () {
    Region::create([
        'name' => 'National Capital Region',
        'short_name' => 'NCR',
    ]);
});

it('should delete an existing site province', function () {
    $provinceData = [
        'name' => 'Laguna',
        'region_id' => 1,
    ];

    $existingProvince = Province::create($provinceData);

    /**
     * @var bool
     */
    $isDeleted = DeleteProvince::run($existingProvince);

    expect($isDeleted)->toBe(true);

    $this->assertDatabaseCount('provinces', 0);
    $this->assertDatabaseMissing('provinces', $provinceData);
});

it('should not delete a non-existent site province', function () {
    /**
     * @var bool
     */
    $isDeleted = DeleteProvince::run(new Province());

    expect($isDeleted)->toBe(false);
});
