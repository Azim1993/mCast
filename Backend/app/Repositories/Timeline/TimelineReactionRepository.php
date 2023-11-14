<?php

namespace App\Repositories\Timeline;

use App\Models\Timeline;
use App\Models\TimelineReaction;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Ramsey\Uuid\Type\Time;

class TimelineReactionRepository extends BaseRepository
{

    function model()
    {
        return TimelineReaction::class;
    }

    protected function checkQuery(Timeline $timeline, User $user): Builder
    {
        return $this->query()
            ->where('user_id', $user->id)
            ->where('timeline_id', $timeline->id);
    }

    public function add(Timeline $timeline, User $user): TimelineReaction
    {
        return $this->model()::create([
            'user_id' => $user->id,
            'timeline_id' => $timeline->id
        ]);
    }

    public function firstExist(Timeline $timeline, User $user): ?TimelineReaction
    {
        return $this->checkQuery($timeline, $user)->first();
    }

    public function remove(Timeline $timeline, User $user): bool
    {
        return $this->checkQuery($timeline, $user)
            ->delete();
    }
}
