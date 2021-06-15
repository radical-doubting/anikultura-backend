<?php

namespace Database\Seeders;

use App\Helpers\PostgresHelper;
use App\Models\Crop;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CropSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date_now = Carbon::now();
        $crops = [
            [
                'id' => 1,
                'group' => 'Banana Group',
                'name' => 'Banana',
                'variety' => 'Banana Variety',
                'establishment_days' => 10,
                'vegetative_days' => 15,
                'yield_formation_days' => 30,
                'ripening_days' => 10,
                'created_at' => $date_now,
                'updated_at' => $date_now
            ]
        ];

        Crop::insert($crops);
        PostgresHelper::update_increments('crops');
    }
}
