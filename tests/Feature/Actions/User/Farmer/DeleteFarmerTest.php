<?php

use App\Actions\User\Farmer\DeleteFarmer;
use App\Models\User\Farmer\Farmer;
use Database\Seeders\Batch\BatchSeeder;
use Database\Seeders\Crop\CropSeeder;
use Database\Seeders\Farmland\FarmlandSeeder;
use Database\Seeders\Site\SiteSeeder;
use Database\Seeders\User\Farmer\FarmerSeeder;
use Database\Seeders\User\RoleSeeder;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed(SiteSeeder::class);
    seed(RoleSeeder::class);
    seed(FarmerSeeder::class);
    seed(CropSeeder::class);
    seed(BatchSeeder::class);
    seed(FarmlandSeeder::class);
});

it('deletes a farmer', function () {
    /**
     * @var Farmer
     */
    $farmer = Farmer::first();

    /**
     * @var bool
     */
    $isDeleted = DeleteFarmer::run($farmer);

    expect($isDeleted)->toBe(true);

    expect($farmer->exists)->toBe(false);

    assertDatabaseMissing('users', [
        'name' => $farmer->name,
    ]);
});
