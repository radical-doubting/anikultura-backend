<?php

namespace Database\Seeders\User\BigBrother;

use App\Models\User\BigBrother\BigBrother;
use App\Models\User\BigBrother\BigBrotherProfile;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use App\Models\User\Role;

class BigBrotherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            BigBrotherProfileSeeder::class,
        ]);

        $profiles = BigBrotherProfile::all();

        $bigBrotherRoleId = Role::where('slug', 'big-brother')
            ->first()
            ->id;

        BigBrother::factory()
            ->count(10)
            ->sequence(fn (Sequence $sequence) => [
                'profile_id' => $profiles->get($sequence->index),
            ])
            ->create()
            ->each(function (BigBrother $bigBrother) use ($bigBrotherRoleId) {
                $bigBrother->roles()->attach($bigBrotherRoleId);
            });
    }
}
