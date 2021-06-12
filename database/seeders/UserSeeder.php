<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date_now = Carbon::now();
        $user = [
            ['name' => 'sadaanton', 'email' => 'sadaanton@student.apc.edu.ph', 'email_verified_at' => $date_now,
            'created_at' => $date_now, 'password' => Hash::make('thisisatest'), 'first_name' => 'Steven',
            'middle_name' => 'Aguinaldo', 'last_name' => 'Da-Anton'],
        ];

        FarmlandType::insert($user);
    }
}
