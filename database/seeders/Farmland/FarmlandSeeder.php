<?php

namespace Database\Seeders\Farmland;

use App\Models\Farmland\Farmland;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FarmlandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $farmlands = [
            [
                'type_id' => 1,
                'status_id' => 1,
                'hectares_size' => 10,
            ],
        ];

        foreach ($farmlands as $farmland) {
            Farmland::create($farmland);
        }

        DB::table('farmland_farmers')->insert([
            'farmland_id' => 1,
            'farmer_id' => 1,
        ]);

        DB::table('farmland_crops')->insert([
            'farmland_id' => 1,
            'crop_id' => 1,
        ]);
    }
}
