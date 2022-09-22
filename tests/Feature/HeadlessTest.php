<?php

use App\Facades\Anikultura;

it('should return json if app is headless', function () {
    Anikultura::shouldReceive('isHeadless')->andReturnTrue();

    $response = $this->get('/');
    $response
        ->assertStatus(200)
        ->assertJson([
            'headless' => true,
        ]);
});

it('should redirect if app is not headless', function () {
    Anikultura::shouldReceive('isHeadless')->andReturnFalse();

    $response = $this->get('/');
    $response
        ->assertRedirect(route('platform.login'));
});
