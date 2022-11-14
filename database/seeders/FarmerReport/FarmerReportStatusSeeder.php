<?php

namespace Database\Seeders\FarmerReport;

use App\Models\FarmerReport\FarmerReportStatus;
use Illuminate\Database\Seeder;

class FarmerReportStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $farmerReportStatuses = [
            ['name' => 'Unverified'],
            ['name' => 'Valid'],
            ['name' => 'Invalid'],
        ];

        foreach ($farmerReportStatuses as $farmerReportStatus) {
            FarmerReportStatus::create($farmerReportStatus);
        }
    }
}
