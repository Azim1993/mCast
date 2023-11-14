<?php

namespace App\Data\DTO;

use Illuminate\Support\Carbon;

class AuthTokenDTO
{
    public function __construct(
        public string $bearerToken,
        public string $refreshToken,
        public ?Carbon $expiredIn = null,
        public ?Carbon $refreshTokenExpiredIn = null
    ) {}
}
