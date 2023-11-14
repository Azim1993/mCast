<?php

namespace App\Repositories\Timeline;

use app\Data\Enums\PreviewPrivacyTypeEnum;
use App\Http\Requests\TimelineRequest;
use App\Models\Timeline;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class TimelineRepository extends BaseRepository
{
    public function __construct()
    {
    }

    public function model()
    {
        return Timeline::class;
    }


    public function getTimelines(): LengthAwarePaginator
    {
        return $this->query()
            ->with('user')
            ->latest()
            ->paginate(30);
    }

    public function addnew(TimelineRequest $request): Timeline
    {
        return $this->create([
            'user_id' => auth()->id(),
            'content' => $request->get('content'),
            'preview_privacy' => $request->get('preview_privacy') ?? PreviewPrivacyTypeEnum::PUBLIC->value
        ]);
    }
}
