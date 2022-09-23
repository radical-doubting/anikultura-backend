<?php

it('should show login screen', function () {
    $screen = screen('platform.login');

    $screen->display()
        ->assertSee('Login')
        ->assertSee('Sign in to your account');
});
