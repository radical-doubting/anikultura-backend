<?php

use App\Models\User\Admin\Admin;
use Database\Seeders\User\Admin\AdminSeeder;
use Database\Seeders\User\RoleSeeder;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed([
        RoleSeeder::class,
        AdminSeeder::class,
    ]);
});

it('shows profile screen', function () {
    $screen = screen('platform.profile')->actingAs(Admin::first());

    $screen->display()
        ->assertSee('My account')
        ->assertSee('Profile Information')
        ->assertSee('Update Password');
});

it('updates profile from the profile screen', function () {
    $screen = screen('platform.profile')->actingAs(Admin::first());

    $screen
        ->method('save', [
            'user' => [
                'first_name' => 'Bob',
                'last_name' => 'Jenkins',
                'name' => 'bobjenkins123',
                'email' => 'bobjenkins123@email.com',
            ],
        ])
        ->assertSee('Profile updated.');
});

it('updates password from the profile screen', function () {
    $screen = screen('platform.profile')->actingAs(Admin::first());

    $screen
        ->method('changePassword', [
            'old_password' => 'password',
            'password_confirmation' => 'SuperSecurePassword1!',
            'password' => 'SuperSecurePassword1!',
        ])
        ->assertSee('Password changed.');
});
