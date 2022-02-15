<?php

namespace Database\Seeders\Crop;

use App\Models\Crop\SeedStage;
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
        $seedStages = [
            ['name' => 'Starter Kit Received'],
            ['name' => 'Seeds Planted'],
            ['name' => 'Seeds Established'],
            ['name' => 'Seeds Vegetative'],
            ['name' => 'Yield Formation Stage'],
            ['name' => 'Ripening Stage'],
            ['name' => 'Crops Harvested'],
            ['name' => 'Marketable'],
        ];

        foreach ($seedStages as $seedStage) {
            SeedStage::create($seedStage);
        }
    }
}
