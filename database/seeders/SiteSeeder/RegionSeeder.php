<?php

namespace Database\Seeders\SiteSeeder;

use App\Models\Site\Region;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
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
            ['id' => 1, 'name' => 'NCR - National Capital Region', 'created_at' => $date_now, 'updated_at' => $date_now],
            ['id' => 2, 'name' => 'CAR - Cordillera Administrative Region', 'created_at' => $date_now, 'updated_at' => $date_now],
            ['id' => 3, 'name' => 'Region I - Ilocos Region', 'created_at' => $date_now, 'updated_at' => $date_now],
            ['id' => 4, 'name' => 'Region II - Cagayan Valley', 'created_at' => $date_now, 'updated_at' => $date_now],
            ['id' => 5, 'name' => 'Region III - Central Luzon', 'created_at' => $date_now, 'updated_at' => $date_now],
            ['id' => 6, 'name' => 'Region IV-A - Calabarzon', 'created_at' => $date_now, 'updated_at' => $date_now],
            ['id' => 7, 'name' => 'Region IV-B - Mimaropa', 'created_at' => $date_now, 'updated_at' => $date_now],
            ['id' => 8, 'name' => 'Region V - Bicol Region', 'created_at' => $date_now, 'updated_at' => $date_now],
            ['id' => 9, 'name' => 'Region VI - Western Visayas', 'created_at' => $date_now, 'updated_at' => $date_now],
            ['id' => 10, 'name' => 'Region VII - Central Visayas', 'created_at' => $date_now, 'updated_at' => $date_now],
            ['id' => 11, 'name' => 'Region VIII - Eastern Visayas', 'created_at' => $date_now, 'updated_at' => $date_now],
            ['id' => 12, 'name' => 'Region IX - Zamboanga Peninsula', 'created_at' => $date_now, 'updated_at' => $date_now],
            ['id' => 13, 'name' => 'Region X - Northern Mindanao', 'created_at' => $date_now, 'updated_at' => $date_now],
            ['id' => 14, 'name' => 'Region XI - Davao Region', 'created_at' => $date_now, 'updated_at' => $date_now],
            ['id' => 15, 'name' => 'Region XII - Soccsksargen', 'created_at' => $date_now, 'updated_at' => $date_now],
            ['id' => 16, 'name' => 'Region XIII - Caraga', 'created_at' => $date_now, 'updated_at' => $date_now],
            ['id' => 17, 'name' => 'BARMM - Bangsamoro', 'created_at' => $date_now, 'updated_at' => $date_now],
        ];

        Region::insert($regions);
    }
}
