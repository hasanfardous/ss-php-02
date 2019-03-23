<?php

namespace App\User2;

abstract class User
{
    public function register()
    {
        echo 'User registered.';
    }

    abstract public function login();
}
