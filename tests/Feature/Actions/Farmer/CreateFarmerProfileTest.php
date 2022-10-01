<?php

use App\Actions\Farmer\CreateFarmerProfile;
use App\Models\User\Farmer\CivilStatus;
use App\Models\User\Farmer\EducationalStatus;
use App\Models\User\Farmer\FarmerProfile;
use App\Models\User\Farmer\Gender;
use App\Models\User\Farmer\NCPasserStatus;
use App\Models\User\Farmer\SalaryPeriodicity;
use App\Models\User\Farmer\SocialStatus;
use Database\Seeders\User\Farmer\CivilStatusSeeder;
use Database\Seeders\User\Farmer\EducationalStatusSeeder;
use Database\Seeders\User\Farmer\GenderSeeder;
use Database\Seeders\User\Farmer\NCPasserStatusSeeder;
use Database\Seeders\User\Farmer\SalaryPeriodicitySeeder;
use Database\Seeders\User\Farmer\SocialStatusSeeder;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed(GenderSeeder::class);
    seed(CivilStatusSeeder::class);
    seed(EducationalStatusSeeder::class);
    seed(SalaryPeriodicitySeeder::class);
    seed(SocialStatusSeeder::class);
    seed(NCPasserStatusSeeder::class);
});

it('adds a farmer profile', function () {
    $gender = Gender::all()->random();
    $civilStatus = CivilStatus::all()->random();
    $educationalStatus = EducationalStatus::all()->random();
    $ncPasserStatus = NCPasserStatus::all()->random();
    $salaryPeriodicity = SalaryPeriodicity::all()->random();
    $socialStatus = SocialStatus::all()->random();

    $farmerProfileData = [
        'gender_id' => $gender->id,
        'civil_status_id' => $civilStatus->id,
        'birthday' => '1990-11-12',
        'quantity_family_members' => 3,
        'quantity_dependents' => 3,
        'quantity_working_dependents' => 2,
        'educational_status_id' => $educationalStatus->id,
        'current_job' => 'Acme Job',
        'farming_years' => 5,
        'usual_crops_planted' => 10,
        'affiliated_organization' => 'Acme Company',
        'tesda_training_joined' => 'Acme Training',
        'nc_passer_status_id' => $ncPasserStatus->id,
        'salary_periodicity_id' => $salaryPeriodicity->id,
        'estimated_salary' => 12000,
        'social_status_id' => $socialStatus->id,
        'social_status_reason' => 'An example reason',
    ];

    /**
     * @var FarmerProfile
     */
    $createdFarmerProfile = CreateFarmerProfile::run(
        new FarmerProfile(),
        $farmerProfileData
    );

    expect($createdFarmerProfile->id)->toBeTruthy();
    expect($createdFarmerProfile->gender->name)->toBe($gender->name);
    expect($createdFarmerProfile->civilStatus->name)->toBe($civilStatus->name);
    expect($createdFarmerProfile->educationalStatus->name)->toBe($educationalStatus->name);
    expect($createdFarmerProfile->ncPasserStatus->name)->toBe($ncPasserStatus->name);
    expect($createdFarmerProfile->salaryPeriodicity->name)->toBe($salaryPeriodicity->name);
    expect($createdFarmerProfile->socialStatus->name)->toBe($socialStatus->name);
    expect($createdFarmerProfile->birthday)->toBe('1990-11-12');
    expect($createdFarmerProfile->quantity_family_members)->toBe(3);
    expect($createdFarmerProfile->quantity_working_dependents)->toBe(2);
    expect($createdFarmerProfile->current_job)->toBe('Acme Job');
    expect($createdFarmerProfile->farming_years)->toBe(5);
    expect($createdFarmerProfile->usual_crops_planted)->toBe('10');
    expect($createdFarmerProfile->affiliated_organization)->toBe('Acme Company');
    expect($createdFarmerProfile->tesda_training_joined)->toBe('Acme Training');
    expect($createdFarmerProfile->estimated_salary)->toBe(12000.0);
    expect($createdFarmerProfile->social_status_reason)->toBe('An example reason');
    expect($createdFarmerProfile->created_at)->toBeTruthy();
    expect($createdFarmerProfile->updated_at)->toBeTruthy();
    expect($createdFarmerProfile->preference)->toBeTruthy();

    assertDatabaseCount('farmer_profiles', 1);
    assertDatabaseHas('farmer_profiles', $farmerProfileData);
});
