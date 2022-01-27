<?php

namespace Database\Seeders\Farmer;

use App\Models\Farmer\Farmer;
use Illuminate\Database\Seeder;

class FarmerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Farmer::factory()->count(10)->create();
    }
}
