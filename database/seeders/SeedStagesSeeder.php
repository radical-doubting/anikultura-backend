<?php

namespace Database\Seeders;

use App\Models\SeedStage;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SeedStagesSeeder extends Seeder
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
            ['id' => 1, 'name' => 'Nakuha ko na ang Starter Kit', 'image' => 'haha1.png'],
            ['id' => 2, 'name' => 'Natanim ko na ang mga buto', 'image' => 'haha2.png'],
            ['id' => 3, 'name' => 'Seeds Established', 'image' => 'haha3.png'],
            ['id' => 4, 'name' => 'Vegetative Seeds', 'image' => 'haha4.png'],
            ['id' => 5, 'name' => 'Yield Formation Stage', 'image' => 'haha5.png'],
            ['id' => 6, 'name' => 'Ripening Stage', 'image' => 'haha6.png'],
        ];

        SeedStage::insert($seedstages);
    }
}
