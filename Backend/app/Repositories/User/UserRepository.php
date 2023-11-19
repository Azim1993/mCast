<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserRepository extends BaseRepository implements UserRepoInterface
{

    function model()
    {
        return User::class;
    }

    /**
     * Here $userInfo is User model email, user_name
     *
     * @param string|null $userInfo
     * @return Collection
     */
    public function searchByUser(?string $userInfo): LengthAwarePaginator
    {
        return $this->query()
            ->when($userInfo, function ($query) use ($userInfo) {
                $query->where('user_name', 'like', "%{$userInfo}%")
                    ->orWhere('email', 'like', "%{$userInfo}%");
            })
            ->paginate(20);
    }

    public function findByUserNameOrEmail(string $userKey): ?User
    {
        $searchKey = filter_var($userKey, FILTER_VALIDATE_EMAIL) ? 'email' : 'user_name';

        return $this->model()::where($searchKey, $userKey)->first();
    }

    public function addNewUser(Request $request): User
    {
        if ($request->hasFile('profile_pic')) {
            $request->merge([
                'profile_pic_src' => Storage::put('profilePic', $request->file('profile_pic'))
            ]);
        }

        if ($request->has('password'))
            $request->merge([
                'password' =>  Hash::make($request->get('password'))
            ]);

        return $this->create($request->except('profile_pic'));
    }

    public function getUserProfile(int $userId): User
    {
        return $this->query()
            ->withCount('followers', 'following')
            ->findOrFail($userId);
    }
}
