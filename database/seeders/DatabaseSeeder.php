<?php

namespace Database\Seeders;

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
        $this->call(FarmlandTypeSeeder::class);
        $this->call(FarmlandStatusSeeder::class);
        $this->call(CropBuyerSeeder::class);
        $this->call(WateringSystemSeeder::class);

        // Data (in order)
        $this->call(CropSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(FarmerProfileSeeder::class);
        $this->call(FarmlandSeeder::class);
    }
}
