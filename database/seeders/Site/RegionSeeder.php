<?php

namespace Database\Seeders\Site;

use App\Helpers\PostgresHelper;
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
        $regions = [
            ['name' => 'NCR - National Capital Region'],
            ['name' => 'CAR - Cordillera Administrative Region'],
            ['name' => 'Region I - Ilocos Region'],
            ['name' => 'Region II - Cagayan Valley'],
            ['name' => 'Region III - Central Luzon'],
            ['name' => 'Region IV-A - Calabarzon'],
            ['name' => 'Region IV-B - Mimaropa'],
            ['name' => 'Region V - Bicol Region'],
            ['name' => 'Region VI - Western Visayas'],
            ['name' => 'Region VII - Central Visayas'],
            ['name' => 'Region VIII - Eastern Visayas'],
            ['name' => 'Region IX - Zamboanga Peninsula'],
            ['name' => 'Region X - Northern Mindanao'],
            ['name' => 'Region XI - Davao Region'],
            ['name' => 'Region XII - Soccsksargen'],
            ['name' => 'Region XIII - Caraga'],
            ['name' => 'BARMM - Bangsamoro'],
        ];

        foreach ($regions as $region) {
            Region::create($region);
        }
    }
}
