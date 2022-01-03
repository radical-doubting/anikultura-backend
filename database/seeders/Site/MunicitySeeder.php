<?php

namespace Database\Seeders\Site;

use App\Models\Site\Municity;
use Illuminate\Database\Seeder;

class MunicitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $municities = [
            [
                'name' => 'Marilao',
                'province_id' => 1,
                'region_id' => 1
            ],
        ];

        foreach ($municities as $municity) {
            Municity::create($municity);
        }
    }
}
