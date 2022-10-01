<?php

namespace Tests\Unit\Actions\User;

use App\Actions\Authentication\HashPassword;
use App\Actions\User\CreateUser;
use App\Models\User\User;
use Mockery;
use PHPUnit\Framework\TestCase;

class CreateUserTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testAvoidUpdatingEmptyPassword(): void
    {
        /**
         * @var \Mockery\Mock&User
         */
        $mockUser = Mockery::mock(User::class)->makePartial();
        $mockUser->shouldReceive('save')->once()->andReturn(true);
        $mockUser->password = 'hashedPassword';

        $hashPassword = Mockery::mock(HashPassword::class);
        $hashPassword->shouldNotReceive('handle');

        $createUser = new CreateUser($hashPassword);

        $createdUser = $createUser->handle($mockUser, [
            'password' => '',
        ]);

        $this->assertEquals($createdUser->password, 'hashedPassword');
    }
}
