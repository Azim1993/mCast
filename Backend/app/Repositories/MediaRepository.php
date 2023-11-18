<?php

namespace App\Repositories;

use App\Data\Enums\MediaTypeEnum;
use App\Models\Media;
use App\Models\Timeline;
use App\Models\TimelineMedia;
use App\Repositories\BaseRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MediaRepository extends BaseRepository
{

    function model(): string
    {
        return Media::class;
    }

    public function storeTimelineImages(Timeline $timeline, ?array $images): ?bool
    {
        if (!$images) { return null; }

        $insertQuery = collect([]);
        foreach ($images as $image) {
            $media = $this->storeImage($image);
            $insertQuery->push(['timeline_id' => $timeline->id, 'media_id' => $media->id]);
        }
        return TimelineMedia::insert($insertQuery->toArray());
    }

    public function storeImage(UploadedFile $image): Media
    {
        return $this->query()->create([
            'src' => Storage::put('timelines', $image),
            'type' => MediaTypeEnum::IMAGE->value
        ]);

    }
}
