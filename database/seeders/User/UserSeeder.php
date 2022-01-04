<?php

namespace Database\Seeders\User;

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
        $dateNow = Carbon::now();

        $users = [
            [
                'name' => 'juandel',
                'email' => 'juandelacruz@gmail.com',
                'email_verified_at' => $dateNow,
                'password' => Hash::make('password'),
                'first_name' => 'Juan',
                'middle_name' => 'Santos',
                'last_name' => 'Dela Cruz',
                'profile_type' => 'App\Models\Farmer\FarmerProfile',
                'profile_id' => 1,
            ],
            [
                'name' => 'pedrogil',
                'email' => 'pedrogil@gmail.com',
                'email_verified_at' => $dateNow,
                'password' => Hash::make('password'),
                'first_name' => 'Pedro',
                'middle_name' => 'Ejercito',
                'last_name' => 'Gil',
                'profile_type' => 'App\Models\Farmer\FarmerProfile',
                'profile_id' => 2,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
