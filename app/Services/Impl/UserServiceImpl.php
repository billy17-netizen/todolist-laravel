<?php

namespace App\Services\Impl;
use App\Services\UserService;

class UserServiceImpl implements UserService
{
    private array $users =
        [
            "Billy"=>"123",
        ];

    public function login(string $email, string $password): bool
    {
        if (array_key_exists($email, $this->users) && $this->users[$email] === $password) {
            return true;
        }else{
            return false;
        }
    }
}
