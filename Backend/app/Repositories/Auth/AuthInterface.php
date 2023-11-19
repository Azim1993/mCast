<?php

namespace App\Repositories\Auth;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthResource;
use App\Models\User;
use Illuminate\Http\Request;

interface AuthInterface
{

    public function login(LoginRequest $request): ?AuthResource;

    public function register(RegisterRequest $request): AuthResource;

    public function logout(User $user): bool;

    public function generateToken(User $user);

    public function handleRefreshToken(Request $request): AuthResource;

}
