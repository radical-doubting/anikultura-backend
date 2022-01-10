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
            ['name' => 'Nakuha ko na ang Starter Kit', 'image' => 'stage1.png'],
            ['name' => 'Natanim ko na ang mga buto', 'image' => 'stage2.png'],
            ['name' => 'Nailipat na ang buto sa lupang tataniman', 'image' => 'stage3.png'],
            ['name' => 'Malalago at malapit na magbunga ang tanim', 'image' => 'stage4.png'],
            ['name' => 'Namumulaklak at unti-unting nagbubunga ang tanim', 'image' => 'stage5.png'],
            ['name' => 'Nagbunga na ang mga tanim at malapit na anihin', 'image' => 'stage6.png'],
            ['name' => 'Naani ko na ang aking mga tanim', 'image' => 'stage7.png'],
            ['name' => 'Maari mo na ibenta ang iyong pananim!', 'image' => 'stage8.png'],
        ];

        foreach ($seedStages as $seedStage) {
            SeedStage::create($seedStage);
        }
    }
}
