<?php

namespace Database\Seeders\BigBrother;

use App\Models\BigBrother\BigBrother;
use Illuminate\Database\Seeder;

class BigBrotherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BigBrother::factory()->count(10)->create();
    }
}
