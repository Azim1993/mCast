<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Repositories\User\FollowRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function getDetail(?int $userId = null)
    {
        $userId = $userId ?? auth()->id();
        return $this->userRepository->findOrFail($userId);
    }

    public function getUsers(Request $request): JsonResponse
    {
        $request->validate(['user_info' => 'nullable|string|max:225']);

        $users = $this->userRepository->searchByUser($request->get('user_info'));
        return $this->jsonResponse(
            'User list',
            new LengthAwarePaginator(
                items: UserResource::collection($users->items()),
                total: $users->total(),
                perPage: $users->perPage(),
                currentPage: $users->currentPage(),
                options: [
                    'path' => asset('api')
                ]
            )
        );
    }
}
