<?php

namespace Database\Seeders\Farmer;

use App\Models\FarmerReport\FarmerReport;
use Illuminate\Database\Seeder;

class FarmerReportSeeder extends Seeder
{
    public function run()
    {
        $farmerReports = [
            [
                'reported_by' => 1,
                'farmland_id' => 1,
                'seed_stage_id' => 1,
                'crop_id' => 1,
                'volume_kg' => 53,
            ],
            [
                'reported_by' => 2,
                'farmland_id' => 1,
                'seed_stage_id' => 1,
                'crop_id' => 1,
                'volume_kg' => 72,
            ],
        ];

        foreach ($farmerReports as $farmerReport) {
            FarmerReport::create($farmerReport);
        }
    }
}
