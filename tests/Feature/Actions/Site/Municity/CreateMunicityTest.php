<?php

use App\Actions\Site\Municity\CreateMunicity;
use App\Models\Site\Municity;
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

    Province::create([
        'name' => 'Laguna',
        'region_id' => 1,
    ]);

    Province::create([
        'name' => 'Quezon',
        'region_id' => 2,
    ]);
});

it('should add a site municipality or city', function () {
    $municityData = [
        'name' => 'Santa Rosa',
        'province_id' => 1,
        'region_id' => 1,
    ];

    /**
     * @var Municity
     */
    $createdMunicity = CreateMunicity::run(
        new Municity(),
        $municityData
    );

    expect($createdMunicity)->toMatchArray(
        $municityData
    );

    expect($createdMunicity->id)->toBeTruthy();
    expect($createdMunicity->slug)->toBe('santa-rosa');
    expect($createdMunicity->region->slug)->toBe('ncr');
    expect($createdMunicity->province->slug)->toBe('laguna');
    expect($createdMunicity->created_at)->toBeTruthy();
    expect($createdMunicity->updated_at)->toBeTruthy();

    $this->assertDatabaseCount('municities', 1);
    $this->assertDatabaseHas('municities', $municityData);
});

it('should update a site municipality or city', function () {
    $existingMunicity = Municity::create([
        'name' => 'Santa Rosa',
        'province_id' => 1,
        'region_id' => 1,
    ]);

    $municityData = [
        'name' => 'Sampaloc',
        'province_id' => 2,
        'region_id' => 2,
    ];

    /**
     * @var Municity
     */
    $updatedMunicity = CreateMunicity::run(
        $existingMunicity,
        $municityData
    );

    expect($updatedMunicity)->toMatchArray(
        $municityData
    );

    expect($updatedMunicity->id)->toBe($existingMunicity->id);
    expect($updatedMunicity->slug)->toBe('sampaloc');
    expect($updatedMunicity->region->slug)->toBe('region-iv-a');
    expect($updatedMunicity->province->slug)->toBe('quezon');
    expect($updatedMunicity->created_at)->toBeTruthy();
    expect($updatedMunicity->updated_at)->toBeTruthy();

    $this->assertDatabaseCount('municities', 1);
    $this->assertDatabaseHas('municities', $municityData);
});
