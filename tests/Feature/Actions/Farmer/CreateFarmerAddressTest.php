<?php

use App\Actions\Farmer\CreateFarmerAddress;
use App\Models\Farmer\FarmerAddress;
use App\Models\Farmer\FarmerProfile;
use App\Models\Site\Region;
use Database\Seeders\Farmer\CivilStatusSeeder;
use Database\Seeders\Farmer\EducationalStatusSeeder;
use Database\Seeders\Farmer\GenderSeeder;
use Database\Seeders\Farmer\NCPasserStatusSeeder;
use Database\Seeders\Farmer\SalaryPeriodicitySeeder;
use Database\Seeders\Farmer\SocialStatusSeeder;
use Database\Seeders\Site\RegionSeeder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed(RegionSeeder::class);
    seed(GenderSeeder::class);
    seed(CivilStatusSeeder::class);
    seed(EducationalStatusSeeder::class);
    seed(SalaryPeriodicitySeeder::class);
    seed(SocialStatusSeeder::class);
    seed(NCPasserStatusSeeder::class);
});

it('adds a farmer address', function () {
    $farmerProfile = FarmerProfile::factory()->create();
    $region = Region::firstWhere('name', 'Calabarzon');

    $farmerAddressData = [
        'house_number' => '177A',
        'street' => 'Bleecker Street',
        'barangay' => 'Poblacion',
        'municity' => 'Santa Rosa',
        'province' => 'Laguna',
        'region_id' => Region::firstWhere('name', 'Calabarzon')->id,
    ];

    /**
     * @var FarmerAddress
     */
    $createdFarmerAddress = CreateFarmerAddress::run(
        $farmerProfile,
        new FarmerAddress(),
        $farmerAddressData
    );

    expect($createdFarmerAddress->id)->toBeTruthy();
    expect($createdFarmerAddress->house_number)->toBe('177A');
    expect($createdFarmerAddress->street)->toBe('Bleecker Street');
    expect($createdFarmerAddress->barangay)->toBe('Poblacion');
    expect($createdFarmerAddress->province)->toBe('Laguna');
    expect($createdFarmerAddress->region->slug)->toBe($region->slug);
    expect($createdFarmerAddress->farmerProfile->id)->toBe($farmerProfile->id);

    assertDatabaseCount('farmer_addresses', 1);
    assertDatabaseHas('farmer_addresses', $farmerAddressData);
});

it('should not add a farmer address on non-existent profile', function () {
    CreateFarmerAddress::run(new FarmerProfile(), new FarmerAddress(), []);
})->throws(
    ModelNotFoundException::class,
    'Cannot add farmer address on non-existent farmer profile'
);
