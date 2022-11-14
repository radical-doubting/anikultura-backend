<?php

namespace Database\Seeders\Farmland;

use App\Models\Batch\Batch;
use App\Models\Farmland\CropBuyer;
use App\Models\Farmland\Farmland;
use App\Models\Farmland\WateringSystem;
use Illuminate\Database\Eloquent\Factories\Sequence;
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

        $batches = Batch::all();

        Farmland::factory()
            ->count(10)
            ->sequence(fn (Sequence $sequence) => [
                'batch_id' => $batches->get($sequence->index),
            ])
            ->create();

        $wateringSystems = WateringSystem::all();
        $cropBuyers = CropBuyer::all();

        Farmland::all()->each(function (Farmland $farmland) use ($wateringSystems, $cropBuyers) {
            $farmland->cropBuyers()->attach(
                $cropBuyers->random(rand(1, $cropBuyers->count()))->pluck('id')->toArray()
            );

            $farmland->wateringSystems()->attach(
                $wateringSystems->random(rand(1, $wateringSystems->count()))->pluck('id')->toArray()
            );

            $farmland->farmers()->attach($farmland->batch->farmers->pluck('id')->toArray());
        });
    }
}
