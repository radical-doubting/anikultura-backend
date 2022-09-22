<?php

namespace Database\Seeders\Farmer;

use App\Models\Farmer\FarmerProfile;
use Illuminate\Database\Seeder;

class FarmerProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            GenderSeeder::class,
            CivilStatusSeeder::class,
            EducationalStatusSeeder::class,
            SalaryPeriodicitySeeder::class,
            SocialStatusSeeder::class,
            NCPasserStatusSeeder::class,
        ]);

        FarmerProfile::factory()->count(10)->create();
    }
}
