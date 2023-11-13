<?php

namespace App\Repositories\Auth;

use App\Http\Requests\LoginRequest;

interface AuthInerface
{

    public function login(LoginRequest $request);

}
