<?php

namespace Database\Seeders;

use App\Models\FarmerProfile;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FarmerProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date_now = Carbon::now();
        $farmer = [
            ['id' => 1, 'gender' => 0, 'civil_status' => 0, 
                'birthday' => '1998-11-11', 'age' => 29, 'quantity_family_members' => 3,
                'quantity_dependents' => 1, 'quantity_working_dependents' => 1, 'highest_educational_status' => 2,
                'college_course' => 'Astronaut', 'current_job' => 'Tagasubo', 'farming_years' => 5, 
                'usual_crops_planted' => 120, 'affiliated_organization' => 'Samahan ng Magsasaka', 
                'tesda_training_joined' => 'SM KSK SAP', 'nc_passer_status' => 0, 'salary_periodicity' => 0,
                'estimated_salary' => 6900, 'social_status' => 0, 
                'social_status_reason' => 'Inaccessibility to opportunities, Rural Area.', 'created_at' => $date_now],
        ];

        FarmerProfile::insert($farmer);
    }
}
