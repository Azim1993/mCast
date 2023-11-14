<?php

namespace App\Repositories\Auth;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthResource;
use App\Models\User;

interface AuthInerface
{

    public function login(LoginRequest $request): ?AuthResource;

    public function register(RegisterRequest $request): AuthResource;

    public function logout(User $user): bool;

    public function generateToken(User $user);

}
