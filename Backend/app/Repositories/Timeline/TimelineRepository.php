<?php

namespace App\Repositories\Timeline;

use app\Data\Enums\PreviewPrivacyTypeEnum;
use App\Http\Requests\TimelineRequest;
use App\Models\Timeline;
use App\Repositories\BaseRepository;
use App\Repositories\MediaRepository;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Pagination\LengthAwarePaginator;

class TimelineRepository extends BaseRepository
{
    public function __construct(
        public MediaRepository $mediaRepository
    )
    {
    }

    public function model()
    {
        return Timeline::class;
    }


    public function getPersonalizeTimelines(): LengthAwarePaginator
    {
        return $this->query()
            ->with(['user', 'images'])
            ->withCount('comments', 'images')
            ->latest()
            ->paginate(30);
    }

    public function addnew(TimelineRequest $request): Timeline
    {
        $timeline = $this->create([
            'user_id' => auth()->id(),
            'content' => $request->get('content'),
            'preview_privacy' => $request->get('preview_privacy') ?? PreviewPrivacyTypeEnum::PUBLIC->value
        ]);

        if ($request->hasFile('images') && sizeof($request->file('images')) > 0) {
            $this->mediaRepository->storeTimelineImages($timeline, $request->file('images'));
        }

        return $timeline;
    }
}
