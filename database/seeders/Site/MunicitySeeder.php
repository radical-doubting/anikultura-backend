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
        Municity::factory()->count(10)->create();
    }
}
