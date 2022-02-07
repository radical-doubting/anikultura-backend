<?php

namespace Database\Seeders\BigBrother;

use App\Models\BigBrother\BigBrotherProfile;
use Illuminate\Database\Seeder;

class BigBrotherProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BigBrotherProfile::factory()->count(10)->create();
    }
}
