<?php

namespace App\Http\Resources;

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
            'user' => new UserResource($this->user),
            'comments' => $this->relationLoaded('comments') ? CommentResource::collection($this->comments) : null
        ];
    }
}
