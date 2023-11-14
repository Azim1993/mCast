<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Http\Request;

interface UserRepoInterface
{
    public function findByUserNameOrEmail(string $userKey): ?User;

    public function addNewUser(Request $request): User;
}
