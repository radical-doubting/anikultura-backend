<?php

use App\Actions\Authentication\HashPassword;
use Illuminate\Support\Facades\Hash;

it('creates a valid password hash', function () {
    $hashedPassword = HashPassword::run('plaintextPassword');
    $isValid = Hash::check('plaintextPassword', $hashedPassword);

    expect($isValid)->toBe(true);
});
