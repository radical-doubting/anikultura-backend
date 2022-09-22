<?php

namespace Database\Seeders\Farmer;

use App\Models\Farmer\Farmer;
use App\Models\Farmer\FarmerProfile;
use Illuminate\Database\Eloquent\Factories\Sequence;
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
        $profiles = FarmerProfile::all();

        Farmer::factory()
            ->count(10)
            ->sequence(fn (Sequence $sequence) => [
                'profile_id' => $profiles->get($sequence->index),
            ])
            ->create();
    }
}
