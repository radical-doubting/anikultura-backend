<?php

use App\Actions\User\Farmer\CreateFarmerPreference;
use App\Models\User\Farmer\FarmerPreference;
use App\Models\User\Farmer\FarmerProfile;
use Database\Seeders\User\Farmer\CivilStatusSeeder;
use Database\Seeders\User\Farmer\EducationalStatusSeeder;
use Database\Seeders\User\Farmer\GenderSeeder;
use Database\Seeders\User\Farmer\NCPasserStatusSeeder;
use Database\Seeders\User\Farmer\SalaryPeriodicitySeeder;
use Database\Seeders\User\Farmer\SocialStatusSeeder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed(GenderSeeder::class);
    seed(CivilStatusSeeder::class);
    seed(EducationalStatusSeeder::class);
    seed(SalaryPeriodicitySeeder::class);
    seed(SocialStatusSeeder::class);
    seed(NCPasserStatusSeeder::class);
});

it('adds a farmer preference', function () {
    $farmerProfile = FarmerProfile::factory()->create();

    /**
     * @var ?FarmerPreference
     */
    $createdFarmerPreference = CreateFarmerPreference::run($farmerProfile);

    expect($createdFarmerPreference->id)->toBeTruthy();
    expect($createdFarmerPreference->tutorial_done)->toBe(false);
});

it('should not add a farmer preference on non-existent profile', function () {
    CreateFarmerPreference::run(new FarmerProfile());
})->throws(
    ModelNotFoundException::class,
    'Cannot add farmer preference on non-existent farmer profile'
);
