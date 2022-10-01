<?php

namespace Database\Seeders\Batch;

use App\Models\Batch\Batch;
use App\Models\User\Farmer\Farmer;
use Illuminate\Database\Seeder;

class BatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $farmerIds = Farmer::all()->pluck('id')->toArray();

        Batch::factory()->count(10)->create();

        foreach (Batch::all() as $batch) {
            $batch->farmers()->attach(array_pop($farmerIds));
        }
    }
}
