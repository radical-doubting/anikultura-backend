<?php

use App\Actions\Farmer\CreateFarmerPreference;
use App\Models\Farmer\FarmerPreference;
use App\Models\Farmer\FarmerProfile;
use Database\Seeders\Farmer\CivilStatusSeeder;
use Database\Seeders\Farmer\EducationalStatusSeeder;
use Database\Seeders\Farmer\GenderSeeder;
use Database\Seeders\Farmer\NCPasserStatusSeeder;
use Database\Seeders\Farmer\SalaryPeriodicitySeeder;
use Database\Seeders\Farmer\SocialStatusSeeder;
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
