<?php

namespace Database\Seeders;

use App\Helpers\PostgresHelper;
use App\Models\Batch\Batch;
use Carbon\Carbon;
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
        $date_now = Carbon::now();
        $batches = [
            [
                'id' => 1,
                'assigned_farmschool_name' => 'Mabuhay High School',
                'region_id' => 5,
                'province_id' => 1,
                'municity_id' => 1,
                'barangay' => 'Nagbalon',
                'number_seeds_distributed' => 1540,
                'created_at' => $date_now,
                'updated_at' => $date_now
            ],
            [
                'id' => 2,
                'assigned_farmschool_name' => 'Masagana Community School',
                'region_id' => 5,
                'province_id' => 1,
                'municity_id' => 1,
                'barangay' => 'Liputan',
                'number_seeds_distributed' => 2250,
                'created_at' => $date_now,
                'updated_at' => $date_now
            ]
        ];

        Batch::insert($batches);
        PostgresHelper::update_increments('batches');

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
