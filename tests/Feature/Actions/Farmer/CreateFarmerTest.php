<?php

use App\Actions\Farmer\CreateFarmer;
use App\Models\Farmer\CivilStatus;
use App\Models\Farmer\EducationalStatus;
use App\Models\Farmer\Farmer;
use App\Models\Farmer\Gender;
use App\Models\Farmer\NCPasserStatus;
use App\Models\Farmer\SalaryPeriodicity;
use App\Models\Farmer\SocialStatus;
use App\Models\Site\Region;
use Database\Seeders\Farmer\CivilStatusSeeder;
use Database\Seeders\Farmer\EducationalStatusSeeder;
use Database\Seeders\Farmer\GenderSeeder;
use Database\Seeders\Farmer\NCPasserStatusSeeder;
use Database\Seeders\Farmer\SalaryPeriodicitySeeder;
use Database\Seeders\Farmer\SocialStatusSeeder;
use Database\Seeders\Site\RegionSeeder;
use Illuminate\Support\Facades\Hash;
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

it('should add a farmer', function () {
    $gender = Gender::all()->random();
    $civilStatus = CivilStatus::all()->random();
    $educationalStatus = EducationalStatus::all()->random();
    $ncPasserStatus = NCPasserStatus::all()->random();
    $salaryPeriodicity = SalaryPeriodicity::all()->random();
    $socialStatus = SocialStatus::all()->random();
    $region = Region::firstWhere('name', 'Calabarzon');

    $farmerData = [
        'account' => [
            'name' => 'juandel',
            'password' => 'password',
        ],
        'profile' => [
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
        ],
        'address' => [
            'house_number' => '177A',
            'street' => 'Bleecker Street',
            'barangay' => 'Poblacion',
            'municity' => 'Santa Rosa',
            'province' => 'Laguna',
            'region_id' => $region->id,
        ],
    ];

    /**
     * @var Farmer
     */
    $createdFarmer = CreateFarmer::run(new Farmer(), $farmerData);

    expect($createdFarmer->id)->toBeTruthy();
    expect($createdFarmer->name)->toBe('juandel');

    $isValid = Hash::check('password', $createdFarmer->password);
    expect($isValid)->toBe(true);

    expect($createdFarmer->profile)->toBeTruthy();
    expect($createdFarmer->profile->farmerAddress)->toBeTruthy();
    expect($createdFarmer->profile->preference)->toBeTruthy();
});
