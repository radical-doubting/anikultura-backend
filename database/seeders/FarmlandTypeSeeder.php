<?php

namespace Database\Seeders;

use App\Helpers\PostgresHelper;
use App\Models\Farmland\FarmlandType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FarmlandTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date_now = Carbon::now();
        $farmland_types = [
            ['id' => 1, 'name' => 'Community Farmland', 'created_at' => $date_now, 'updated_at' => $date_now],
            ['id' => 2, 'name' => 'Personal Farmland', 'created_at' => $date_now, 'updated_at' => $date_now],
        ];

        FarmlandType::insert($farmland_types);
        PostgresHelper::update_increments('farmland_types');
    }
}
