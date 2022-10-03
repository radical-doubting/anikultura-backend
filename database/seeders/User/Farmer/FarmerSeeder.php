<?php

namespace Database\Seeders\User\Farmer;

use App\Models\User\Farmer\Farmer;
use App\Models\User\Farmer\FarmerProfile;
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
        $this->call([
            FarmerProfileSeeder::class,
            FarmerPreferenceSeeder::class,
            FarmerAddressSeeder::class,
        ]);

        $profiles = FarmerProfile::all();

        Farmer::factory()
            ->count(10)
            ->sequence(fn (Sequence $sequence) => [
                'profile_id' => $profiles->get($sequence->index),
            ])
            ->create();
    }
}
