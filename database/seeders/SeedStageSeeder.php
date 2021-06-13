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
            ['id' => 3, 'name' => 'Nailipat na ang buto sa lupang tataniman', 'image' => 'stage3.png'],
            ['id' => 4, 'name' => 'Malalago at malapit na magbunga ang tanim', 'image' => 'stage4.png'],
            ['id' => 5, 'name' => 'Namumulaklak at unti-unting nagbubunga ang tanim', 'image' => 'stage5.png'],
            ['id' => 6, 'name' => 'Nagbunga na ang mga tanim at malapit na anihin', 'image' => 'stage6.png'],
            ['id' => 7, 'name' => 'Naani ko na aking mga tanim', 'image' => 'stage7.png'],
        ];

        SeedStage::insert($seedstages);
    }
}
