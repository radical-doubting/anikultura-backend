<?php

use App\Actions\Site\Province\CreateProvince;
use App\Models\Site\Province;
use App\Models\Site\Region;

beforeEach(function () {
    Region::create([
        'name' => 'National Capital Region',
        'short_name' => 'NCR',
    ]);

    Region::create([
        'name' => 'Calabarzon',
        'short_name' => 'Region IV-A',
    ]);
});

it('adds a site province', function () {
    $provinceData = [
        'name' => 'Laguna',
        'region_id' => Region::firstWhere('name', 'National Capital Region')->id,
    ];

    /**
     * @var Province
     */
    $createdProvince = CreateProvince::run(
        new Province(),
        $provinceData
    );

    expect($createdProvince)->toMatchArray(
        $provinceData
    );

    expect($createdProvince->id)->toBeTruthy();
    expect($createdProvince->slug)->toBe('laguna');
    expect($createdProvince->region->slug)->toBe('ncr');
    expect($createdProvince->created_at)->toBeTruthy();
    expect($createdProvince->updated_at)->toBeTruthy();

    $this->assertDatabaseCount('provinces', 1);
    $this->assertDatabaseHas('provinces', $provinceData);
});

it('updates a site province', function () {
    $existingProvince = Province::create([
        'name' => 'Laguna',
        'region_id' => Region::firstWhere('name', 'National Capital Region')->id,
    ]);

    $provinceData = [
        'name' => 'Quezon',
        'region_id' => Region::firstWhere('name', 'Calabarzon')->id,
    ];

    /**
     * @var Province
     */
    $updatedProvince = CreateProvince::run(
        $existingProvince,
        $provinceData
    );

    expect($updatedProvince)->toMatchArray(
        $provinceData
    );

    expect($updatedProvince->id)->toBe($existingProvince->id);
    expect($updatedProvince->slug)->toBe('quezon');
    expect($updatedProvince->region->slug)->toBe('region-iv-a');
    expect($updatedProvince->created_at)->toBeTruthy();
    expect($updatedProvince->updated_at)->toBeTruthy();

    $this->assertDatabaseCount('provinces', 1);
    $this->assertDatabaseHas('provinces', $provinceData);
});
