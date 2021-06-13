<?php

namespace Database\Seeders;

use Database\Seeders\SiteSeeder\MunicitySeeder;
use Database\Seeders\SiteSeeder\ProvinceSeeder;
use Database\Seeders\SiteSeeder\RegionSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Metadata
        $this->call(RegionSeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(MunicitySeeder::class);

        $this->call(FarmlandTypeSeeder::class);
        $this->call(FarmlandStatusSeeder::class);
        $this->call(CropBuyerSeeder::class);
        $this->call(WateringSystemSeeder::class);
        $this->call(SeedStageSeeder::class);

        // Data (in order)
        $this->call(CropSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(FarmerProfileSeeder::class);
        $this->call(FarmlandSeeder::class);
    }
}
