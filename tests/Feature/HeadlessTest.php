<?php

use App\Facades\Anikultura;
use function Pest\Laravel\get;

it('should return json if app is headless', function () {
    Anikultura::shouldReceive('isHeadless')->andReturnTrue();

    $response = get('/');
    $response
        ->assertStatus(200)
        ->assertJson([
            'headless' => true,
        ]);
});

it('should redirect if app is not headless', function () {
    Anikultura::shouldReceive('isHeadless')->andReturnFalse();

    $response = get('/');
    $response
        ->assertRedirect(route('platform.login'));
});
