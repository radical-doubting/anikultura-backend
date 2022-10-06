<?php

use App\Actions\User\BigBrother\CreateBigBrotherProfile;
use App\Models\User\BigBrother\BigBrotherProfile;
use Database\Seeders\User\RoleSeeder;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        RoleSeeder::class,
    ]);
});

it('adds a big brother profile', function () {
    $bigBrotherProfileData = [
        'age' => 27,
        'organization_name' => 'Acme Org',
    ];

    /**
     * @var BigBrotherProfile
     */
    $createdBigBrotherProfile = CreateBigBrotherProfile::run(
        new BigBrotherProfile(),
        $bigBrotherProfileData
    );

    expect($createdBigBrotherProfile->id)->toBeTruthy();
    expect($createdBigBrotherProfile->age)->toBe(27);
    expect($createdBigBrotherProfile->organization_name)->toBe('Acme Org');

    assertDatabaseCount('big_brother_profiles', 1);
    assertDatabaseHas('big_brother_profiles', $bigBrotherProfileData);
});
