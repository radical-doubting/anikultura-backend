<?php

namespace Database\Seeders\Farmer;

use App\Models\User\Farmer\FarmerPreference;
use App\Models\User\Farmer\FarmerProfile;
use Illuminate\Database\Eloquent\Factories\Sequence;
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
        $profiles = FarmerProfile::all();

        FarmerPreference::factory()
            ->count(10)
            ->sequence(fn (Sequence $sequence) => [
                'farmer_profile_id' => $profiles->get($sequence->index),
            ])
            ->create();
    }
}
