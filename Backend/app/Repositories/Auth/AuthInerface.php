<?php

namespace App\Repositories\Auth;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthResource;

interface AuthInerface
{

    public function login(LoginRequest $request): AuthResource;

    public function register(RegisterRequest $request): AuthResource;

}
