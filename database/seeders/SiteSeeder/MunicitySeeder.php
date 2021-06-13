<?php

namespace Database\Seeders\SiteSeeder;

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
        $provinces = [
            ['id' => 1, 'name' => 'Marilao', 'created_at' => $date_now, 'updated_at' => $date_now],
        ];

        Municity::insert($provinces);
    }
}
