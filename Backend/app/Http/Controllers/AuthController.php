<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\Auth\AuthInerface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthController extends Controller
{
    public function __construct(
        private AuthInerface $authInerface
    ) {}

    public function register(RegisterRequest $request): JsonResponse
    {
        return $this->jsonResponse(
            'Register successfully',
            $this->authInerface->register($request)
        );
    }

    /**
     * @throws ValidationException
     */
    public function login(LoginRequest $request): JsonResponse
    {

        $this->ensureIsNotRateLimited($request);

        if ($authUser = $this->authInerface->login($request)) {
            return $this->jsonResponse(
                'Login successfully',
                $authUser
            );
        }

        RateLimiter::hit($this->throttleKey($request), 5);

        return $this->jsonResponse('Invalid Credentials', null, ResponseAlias::HTTP_UNAUTHORIZED);
    }

    public function logout(Request $request): JsonResponse
    {
        try {
            $this->authInerface->logout($request->user());
            return $this->jsonResponse(
                'Logout successfully',
            );
        }
        catch (\Exception $exception) {
            return $this->jsonResponse(
                'Some error Happened',
                $exception->getMessage(),
                ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


    /**
     * @throws ValidationException
     */
    protected function ensureIsNotRateLimited(LoginRequest $request): void
    {
        if (RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            throw ValidationException::withMessages([
                'email' => 'Too many login attempts. Please try again after 5 minutes.',
            ])
            ->status(429);
        }
    }

    protected function throttleKey(LoginRequest $request): string
    {
        return mb_strtolower($request->get('user')).'|'.$request->ip();
    }
}
