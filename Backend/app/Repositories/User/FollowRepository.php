<?php

namespace App\Repositories\User;

use App\Models\Follower;
use App\Models\User;
use App\Repositories\BaseRepository;
use HttpInvalidParamException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class FollowRepository extends BaseRepository
{

    function model()
    {
        return Follower::class;
    }


    public function follow(User $user, User $follower): Follower
    {
        $this->checkValidParams($user, $follower);

        $alreadyExistCheck = $this->query()->where('user_id', $user->id)->where('follower_id', $follower->id)->first();
        if ($alreadyExistCheck) {
            throw new UnprocessableEntityHttpException('Already following');
        }

        return $this->query()->create([
            'user_id' => $user->id,
            'follower_id' => $follower->id
        ]);
    }


    public function unfollow(User $user, User $follower)
    {
        $this->checkValidParams($user, $follower);
        return $user->follow()->detach($follower);
    }

    private function checkValidParams(User $user, User $follower)
    {
        if ($user->id == $follower->id) {
            throw new BadRequestHttpException('Invalid follower data provided');
        }
    }

}
