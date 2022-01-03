<?php

namespace Database\Seeders\User;

use App\Helpers\PostgresHelper;
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

        $users = [
            [
                'name' => 'juandel',
                'email' => 'juandelacruz@gmail.com',
                'email_verified_at' => $date_now,
                'password' => Hash::make('password'),
                'first_name' => 'Juan',
                'middle_name' => 'Santos',
                'last_name' => 'Dela Cruz',
                'profile_type' => 'App\Models\Farmer\FarmerProfile',
                'profile_id' => 1,
                'created_at' => $date_now,
                'updated_at' => $date_now
            ],
            [
                'name' => 'pedrogil',
                'email' => 'pedrogil@gmail.com',
                'email_verified_at' => $date_now,
                'created_at' => $date_now,
                'password' => Hash::make('password'),
                'first_name' => 'Pedro',
                'middle_name' => 'Ejercito',
                'last_name' => 'Gil',
                'profile_type' => 'App\Models\Farmer\FarmerProfile',
                'profile_id' => 2,
                'created_at' => $date_now,
                'updated_at' => $date_now
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
