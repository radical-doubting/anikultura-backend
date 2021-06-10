<?php

namespace Database\Seeders;

use App\Models\Farmland\WateringSystem;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WateringSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date_now = Carbon::now();
        $regions = [
            ['id' => 1, 'name' => 'Well', 'created_at' => $date_now],
            ['id' => 2, 'name' => 'NIA Canal / Irrigation', 'created_at' => $date_now],
            ['id' => 3, 'name' => 'Spring', 'created_at' => $date_now],
            ['id' => 4, 'name' => 'Shallow Tube Well', 'created_at' => $date_now],
            ['id' => 5, 'name' => 'Creek', 'created_at' => $date_now],
            ['id' => 6, 'name' => 'Faucet', 'created_at' => $date_now],
            ['id' => 7, 'name' => 'Rain Water', 'created_at' => $date_now],
        ];

        WateringSystem::insert($regions);
    }
}
