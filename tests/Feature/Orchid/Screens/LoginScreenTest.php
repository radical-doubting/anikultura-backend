<?php

namespace Tests\Feature\Orchid\Screens;

use Orchid\Support\Testing\ScreenTesting;
use Tests\TestCase;

class LoginScreenTest extends TestCase
{
    use ScreenTesting;

    /**
     * A basic test example.
     */
    public function testShouldShowScreen()
    {
        $screen = $this->screen('platform.login');

        $screen->display()
            ->assertSee('Login')
            ->assertSee('Sign in to your account');
    }
}
