<?php

namespace Database\Seeders\Farmer;

use App\Models\Farmer\FarmerPreference;
use Illuminate\Database\Seeder;

class FarmerPreferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FarmerPreference::factory()->count(10)->create();
    }
}
