<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TimelineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'preview_privacy' => $this->preview_privacy,
            'total_reaction' => $this->total_reaction,
            'total_comments' => $this->comments_count,
            'created_at' => $this->created_at,
            'created_at_human_diff' => Carbon::parse($this->created_at)->diffForHumans(),
            'images' => $this->relationLoaded('images') ? TimelinePivotMedia::collection($this->images) : null,
            'user' => new UserResource($this->user),
            'comments' => $this->relationLoaded('comments') ? CommentResource::collection($this->comments) : null
        ];
    }
}
