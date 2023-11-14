<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserRepository extends BaseRepository implements UserRepoInterface
{

    function model()
    {
        return User::class;
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
}
