<?php

namespace Database\Seeders\Site;

use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RegionSeeder::class,
            ProvinceSeeder::class,
            MunicitySeeder::class,
        ]);
    }
}
