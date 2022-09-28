<?php

use function Pest\Laravel\get;

it('exports metrics', function () {
    $response = get('/metrics');
    $response
        ->assertStatus(200);
});
