<?php

use App\Facades\AnikulturaFacade as Anikultura;
use function Pest\Laravel\get;

it('returns json if app is headless', function () {
    Anikultura::shouldReceive('isHeadless')->andReturnTrue();

    $response = get('/');
    $response
        ->assertStatus(200)
        ->assertJson([
            'headless' => true,
        ]);
});

it('redirects if app is not headless', function () {
    Anikultura::shouldReceive('isHeadless')->andReturnFalse();

    $response = get('/');
    $response
        ->assertRedirect(route('platform.login'));
});
