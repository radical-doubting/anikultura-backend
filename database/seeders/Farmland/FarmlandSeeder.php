<?php

namespace Database\Seeders\Farmland;

use App\Models\User\Farmer\Farmer;
use App\Models\Farmland\CropBuyer;
use App\Models\Farmland\Farmland;
use App\Models\Farmland\WateringSystem;
use Illuminate\Database\Seeder;

class FarmlandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            FarmlandTypeSeeder::class,
            FarmlandStatusSeeder::class,

            WateringSystemSeeder::class,
        ]);

        Farmland::factory()->count(10)->create();

        $wateringSystems = WateringSystem::all();
        $cropBuyers = CropBuyer::all();
        $farmers = Farmer::all();

        Farmland::all()->each(function ($farmland) use ($wateringSystems, $cropBuyers, $farmers) {
            $farmland->cropBuyers()->attach(
                $cropBuyers->random(rand(1, $cropBuyers->count()))->pluck('id')->toArray()
            );

            $farmland->wateringSystems()->attach(
                $wateringSystems->random(rand(1, $wateringSystems->count()))->pluck('id')->toArray()
            );

            $farmland->farmers()->attach(
                $farmers->random(rand(1, $farmers->count()))->pluck('id')->toArray()
            );
        });
    }
}
