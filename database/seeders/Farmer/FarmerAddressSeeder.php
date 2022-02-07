<?php

namespace Database\Seeders\Farmer;

use App\Models\Farmer\FarmerAddress;
use Illuminate\Database\Seeder;

class FarmerAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FarmerAddress::factory()->count(10)->create();
    }
}
