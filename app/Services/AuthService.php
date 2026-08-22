<?php

namespace App\Services;

use App\Http\Requests\UserRequest;

class AuthService
{
    public function __construct(private AuthStrategyInterface $strategy)
    {}

    public function login(UserRequest $request)
    {
        return $this->strategy->login($request);
    }

    public function logout(UserRequest $request)
    {
        return $this->strategy->logout($request);
    }

    public function user(UserRequest $request)
    {
        return $this->strategy->user($request);
    }
}