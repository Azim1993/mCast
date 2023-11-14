<?php

namespace App\Http\Controllers;

use App\Repositories\User\FollowRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        public UserRepository $userRepository,
        public FollowRepository $followRepository
    ) {}


    public function follow($userId): JsonResponse
    {
        $user = auth()->user();
        $follower = $this->userRepository->findOrFail($userId);
        $this->followRepository->follow($user, $follower);
        return $this->jsonResponse(
            "Now, you following {$follower->name}"
        );
    }

    public function unfollow($userId): JsonResponse
    {
        $user = auth()->user();
        $follower = $this->userRepository->findOrFail($userId);
        $this->followRepository->unfollow($user, $follower);
        return $this->jsonResponse(
            "You unfollowed {$follower->name} successfully"
        );
    }

    public function getDetail()
    {
        dd(auth()->user());
    }
}
