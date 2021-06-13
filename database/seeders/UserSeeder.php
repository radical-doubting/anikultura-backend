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
            [
                'id' => 1,
                'name' => 'juandel',
                'email' => 'juandelacruz@gmail.com',
                'email_verified_at' => $date_now,
                'created_at' => $date_now,
                'password' => Hash::make('password'),
                'first_name' => 'Juan',
                'middle_name' => 'Santos',
                'last_name' => 'Dela Cruz',
                'profile_type' => 'App\Models\Farmer\FarmerProfile',
                'profile_id' => 1
            ],
        ];

        User::insert($user);
    }
}
