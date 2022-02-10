<?php

namespace Database\Seeders\Batch;

use App\Models\Batch\Batch;
use App\Models\Farmer\Farmer;
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
        $farmers = Farmer::all();

        Batch::factory()->count(10)->create()->each(function ($batch) use ($farmers) {
            $batch->farmers()->attach(
                $farmers->random(rand(1, $farmers->count()))->pluck('id')->toArray()
            );
        });
    }
}
