<?php

use App\Actions\User\BigBrother\DeleteBigBrother;
use App\Models\User\BigBrother\BigBrother;
use Database\Seeders\User\BigBrother\BigBrotherSeeder;
use Database\Seeders\User\RoleSeeder;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed(RoleSeeder::class);
    seed(BigBrotherSeeder::class);
});

it('deletes a big brother', function () {
    /**
     * @var BigBrother
     */
    $bigBrother = BigBrother::first();
    $bigBrotherProfileId = $bigBrother->profile->id;

    /**
     * @var bool
     */
    $isDeleted = DeleteBigBrother::run($bigBrother);

    expect($isDeleted)->toBe(true);

    expect($bigBrother->exists)->toBe(false);

    assertDatabaseMissing('users', [
        'name' => $bigBrother->name,
    ]);

    assertDatabaseMissing('big_brother_profiles', [
        'id' => $bigBrotherProfileId,
    ]);
});
