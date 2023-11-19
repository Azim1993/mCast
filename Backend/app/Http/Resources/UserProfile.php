<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfile extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'name' => $this->name,
            'user_name' => $this->user_name,
            'email' => $this->email,
            'profile_pic' => $this->profile_pic_src,
            'total_followers' => $this->followers_count,
            'total_following' => $this->following_count
        ];
    }
}
