<?php

use App\Actions\Site\Municity\DeleteMunicity;
use App\Models\Site\Municity;
use App\Models\Site\Province;
use App\Models\Site\Region;

beforeEach(function () {
    $region = Region::create([
        'name' => 'National Capital Region',
        'short_name' => 'NCR',
    ]);

    Province::create([
        'name' => 'Laguna',
        'region_id' => $region->id,
    ]);
});

it('should delete an existing site municipality or city', function () {
    $municityData = [
        'name' => 'Santa Rosa',
        'province_id' => Province::firstWhere('name', 'Laguna')->id,
        'region_id' => Region::firstWhere('name', 'National Capital Region')->id,
    ];

    $existingProvince = Municity::create($municityData);

    /**
     * @var bool
     */
    $isDeleted = DeleteMunicity::run($existingProvince);

    expect($isDeleted)->toBe(true);

    $this->assertDatabaseCount('municities', 0);
    $this->assertDatabaseMissing('municities', $municityData);
});

it('should not delete a non-existent site municipality or city', function () {
    /**
     * @var bool
     */
    $isDeleted = DeleteMunicity::run(new Municity());

    expect($isDeleted)->toBe(false);
});
