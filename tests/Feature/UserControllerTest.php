<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get('/login')
            ->assertStatus(200)
            ->assertViewIs('user.login')
            ->assertViewHas('title', 'Login');
    }

    public function testLoginPageForMember()
    {
        $this->withSession(['user' => 'Billy'])
            ->get('/login')
            ->assertRedirect('/');
    }

    public function testLoginSuccess()
    {
        $this->post('/login', [
            'user' => 'Billy',
            'password' => '123',
        ])
            ->assertStatus(302)
            ->assertRedirect('/')   // redirect to home page
            ->assertSessionHas('user', 'Billy');
    }

    public function testLoginForUserAlreadyLogin()
    {
        $this->withSession(['user' => 'Billy'])
            ->post('/login', [
            'user' => 'Billy',
            'password' => '123',
        ])
            ->assertStatus(302)
            ->assertRedirect('/');  // redirect to home page
    }

    public function testLoginValidationError()
    {
        $this->post('/login', [])
            ->assertSeeText('User or Passwords is required');
    }

    public function testLoginFailed()
    {
        $this->post('/login', [
            'user' => 'Eko',
            'password' => '456',
        ])
            ->assertSeeText('User or Passwords is incorrect');
    }

    public function testLogout()
    {
        $this->withSession(["user" => "Billy"])
            ->post('/logout')
            ->assertRedirect('/')
            ->assertSessionMissing('user');
    }

    public function testLogoutGuest()
    {
        $this->post('/logout')
            ->assertRedirect('/');
    }
}
