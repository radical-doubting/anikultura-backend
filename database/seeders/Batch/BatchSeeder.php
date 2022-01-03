<?php

namespace Database\Seeders\Batch;

use App\Models\Batch\Batch;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $batches = [
            [
                'assigned_farmschool_name' => 'Mabuhay High School',
                'region_id' => 5,
                'province_id' => 1,
                'municity_id' => 1,
                'barangay' => 'Nagbalon',
                'number_seeds_distributed' => 1540
            ],
            [
                'assigned_farmschool_name' => 'Masagana Community School',
                'region_id' => 5,
                'province_id' => 1,
                'municity_id' => 1,
                'barangay' => 'Liputan',
                'number_seeds_distributed' => 2250
            ]
        ];

        foreach ($batches as $batch) {
            Batch::create($batch);
        }

        DB::table('batch_farmers')->insert([
            'batch_id' => 1,
            'farmer_id' => 1
        ]);

        DB::table('batch_farmers')->insert([
            'batch_id' => 1,
            'farmer_id' => 2
        ]);
    }
}
