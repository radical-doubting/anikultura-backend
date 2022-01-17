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
        Province::factory()->count(10)->create();
    }
}
