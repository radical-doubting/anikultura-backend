<?php

namespace Database\Seeders\Site;

use App\Models\Site\Province;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinces = [
            [
                'name' => 'Bulacan',
                'region_id' => 1
            ],
        ];

        foreach ($provinces as $province) {
            Province::create($province);
        }
    }
}
