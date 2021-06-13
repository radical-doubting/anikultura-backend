<?php

namespace Database\Seeders\SiteSeeder;

use App\Models\Site\Province;
use Carbon\Carbon;
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
        $date_now = Carbon::now();
        $provinces = [
            ['id' => 1, 'name' => 'Bulacan', 'created_at' => $date_now, 'updated_at' => $date_now],
        ];

        Province::insert($provinces);
    }
}
