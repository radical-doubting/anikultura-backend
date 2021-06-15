<?php

namespace Database\Seeders\SiteSeeder;

use App\Helpers\PostgresHelper;
use App\Models\Site\Municity;
use Carbon\Carbon;
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
        $date_now = Carbon::now();
        $municities = [
            [
                'id' => 1,
                'name' => 'Marilao',
                'province_id' => 1,
                'region_id' => 1,
                'created_at' => $date_now,
                'updated_at' => $date_now
            ],
        ];

        Municity::insert($municities);
        PostgresHelper::update_increments('municities');
    }
}
