<?php

namespace App\Repositories\Auth;

use App\Data\DTO\AuthTokenDTO;
use App\Data\Enums\TokenTypeEnum;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthResource;
use App\Models\User;
use App\Repositories\Auth\AuthInterface;
use App\Repositories\User\UserRepoInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class AuthService implements AuthInterface
{

    public function __construct(
        private UserRepoInterface $userRepo
    ) {}

    public function login(LoginRequest $request): ?AuthResource
    {
        $authParams = [
            'user_name' => $request->get('user'),
            'password'  => $request->get('password')
        ];


        if (!Auth::attempt($authParams)) {
            return null;
        }

        $user = $this->userRepo->findByUserNameOrEmail($request->get('user'));
        return new AuthResource($user, $this->generateToken($user));
    }

    public function register(RegisterRequest $request): AuthResource
    {
        $user = $this->userRepo->addNewUser(new Request($request->except('password_confirmation')));
        return new AuthResource($user, $this->generateToken($user));
    }


    public function logout(User $user): bool
    {
        return $user->currentAccessToken()->delete();
    }

    public function handleRefreshToken(Request $request): AuthResource
    {
        $tokenString = $request->header('Authorization');
        $token = substr($tokenString, 7);
        $user = auth()->user();
        PersonalAccessToken::findToken($token)->delete();
        return new AuthResource($user, $this->generateToken($user));
    }

    public function generateToken(User $user): AuthTokenDTO
    {
        $apiTokenExpiredAt = now()->addMinutes(config('sanctum.expiration'));
        $apiToken = $user->createToken(TokenTypeEnum::API_TOKEN->value, [TokenTypeEnum::API_TOKEN->value], $apiTokenExpiredAt);

        $refreshTokenExpiredAt = now()->addMinutes(config('sanctum.rt_expiration'));
        $refreshToken = $user->createToken(TokenTypeEnum::REFRESH_TOKEN->value, [TokenTypeEnum::REFRESH_TOKEN->value], $refreshTokenExpiredAt);

        return new AuthTokenDTO(
            bearerToken: $apiToken->plainTextToken,
            refreshToken: $refreshToken->plainTextToken,
            expiredIn: $apiTokenExpiredAt,
            refreshTokenExpiredIn: $refreshTokenExpiredAt
        );
    }
}
