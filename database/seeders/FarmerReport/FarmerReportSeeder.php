<?php

namespace Database\Seeders\FarmerReport;

use App\Models\Crop\Crop;
use App\Models\Crop\SeedStage;
use App\Models\Farmer\Farmer;
use App\Models\FarmerReport\FarmerReport;
use App\Models\Farmland\Farmland;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class FarmerReportSeeder extends Seeder
{
    public function run()
    {
        $farmers = Farmer::all();
        $farmland = Farmland::first();
        $seedStage = SeedStage::first();
        $crop = Crop::first();

        FarmerReport::factory()
            ->count(2)
            ->sequence(fn (Sequence $sequence) => [
                'reported_by' => $farmers->get($sequence->index),
                'farmland_id' => $farmland,
                'seed_stage_id' => $seedStage,
                'crop_id' => $crop,
            ])
            ->create();
    }
}
