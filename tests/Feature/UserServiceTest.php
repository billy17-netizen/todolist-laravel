<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = app(UserService::class);
    }

    public function testLoginSuccess(): void
    {
        self::assertTrue($this->userService->login("Billy", "123"));
    }

    public function testLoginUserNotFound(): void
    {
        self::assertFalse($this->userService->login("Eko", "456"));
    }

    public function testLoginWrongPassword(): void
    {
        self::assertFalse($this->userService->login("Billy", "456"));
    }
}
