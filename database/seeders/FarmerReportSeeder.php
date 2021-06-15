<?php

namespace Database\Seeders;

use App\Helpers\PostgresHelper;
use App\Models\FarmerReport;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FarmerReportSeeder extends Seeder
{
    public function run()
    {
        $date_now = Carbon::now();
        $farmer_reports = [
            [
                'id' => 1,
                'farmer_id' => 1,
                'farmland_id' => 1,
                'seed_stage_id' => 1,
                'crop_id' => 1,
                'volume' => 53,
                'created_at' => $date_now,
                'updated_at' => $date_now
            ],
            [
                'id' => 2,
                'farmer_id' => 2,
                'farmland_id' => 1,
                'seed_stage_id' => 1,
                'crop_id' => 1,
                'volume' => 72,
                'created_at' => $date_now,
                'updated_at' => $date_now
            ]
        ];

        FarmerReport::insert($farmer_reports);
        PostgresHelper::update_increments('farmer_reports');
    }
}
