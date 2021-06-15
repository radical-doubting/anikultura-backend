<?php

namespace Database\Seeders;

use App\Helpers\PostgresHelper;
use App\Models\Farmland\Farmland;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FarmlandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date_now = Carbon::now();
        $farmlands = [
            [
                'id' => 1,
                'type_id' => 1,
                'status_id' => 1,
                'hectares_size' => 10,
                'created_at' => $date_now,
                'updated_at' => $date_now
            ]
        ];

        Farmland::insert($farmlands);
        PostgresHelper::update_increments('farmlands');

        DB::table('farmland_farmers')->insert([
            'farmland_id' => 1,
            'farmer_id' => 1
        ]);

        DB::table('farmland_crops')->insert([
            'farmland_id' => 1,
            'crop_id' => 1
        ]);
    }
}
