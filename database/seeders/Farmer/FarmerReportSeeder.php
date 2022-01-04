<?php

namespace Database\Seeders\Farmer;

use App\Models\FarmerReport;
use Illuminate\Database\Seeder;

class FarmerReportSeeder extends Seeder
{
    public function run()
    {
        $farmerReports = [
            [
                'farmer_id' => 1,
                'farmland_id' => 1,
                'seed_stage_id' => 1,
                'crop_id' => 1,
                'volume' => 53,
            ],
            [
                'farmer_id' => 2,
                'farmland_id' => 1,
                'seed_stage_id' => 1,
                'crop_id' => 1,
                'volume' => 72,
            ],
        ];

        foreach ($farmerReports as $farmerReport) {
            FarmerReport::create($farmerReport);
        }
    }
}
