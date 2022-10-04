<?php

namespace Database\Seeders\FarmerReport;

use App\Models\FarmerReport\FarmerReport;
use App\Models\User\Farmer\Farmer;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class FarmerReportSeeder extends Seeder
{
    public function run()
    {
        $farmers = Farmer::all();

        FarmerReport::factory()
            ->count(2)
            ->sequence(fn (Sequence $sequence) => [
                'reported_by' => $farmers->get($sequence->index),
            ])
            ->create();
    }
}
