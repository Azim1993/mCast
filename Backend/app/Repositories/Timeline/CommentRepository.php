<?php

namespace App\Repositories\Timeline;

use App\Models\Timeline;
use App\Models\TimelineComment;
use App\Models\User;
use App\Repositories\BaseRepository;

class CommentRepository extends BaseRepository
{

    function model()
    {
        return TimelineComment::class;
    }

    public function addNew(Timeline $timeline, User $user, string $content): TimelineComment
    {
        return $this->create([
            'timeline_id' => $timeline->id,
            'user_id' => $user->id,
            'comment' => $content
        ]);
    }
}
