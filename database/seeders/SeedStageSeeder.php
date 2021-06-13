<?php

namespace Database\Seeders;

use App\Models\SeedStage;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SeedStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date_now = Carbon::now();
        $seedstages = [
            ['id' => 1, 'name' => 'Nakuha ko na ang Starter Kit', 'image' => 'stage1.png'],
            ['id' => 2, 'name' => 'Natanim ko na ang mga buto', 'image' => 'stage2.png'],
            ['id' => 3, 'name' => 'Seeds Established', 'image' => 'stage3.png'],
            ['id' => 4, 'name' => 'Vegetative Seeds', 'image' => 'stage4.png'],
            ['id' => 5, 'name' => 'Yield Formation Stage', 'image' => 'stage5.png'],
            ['id' => 6, 'name' => 'Ripening Stage', 'image' => 'stage6.png'],
        ];

        SeedStage::insert($seedstages);
    }
}
