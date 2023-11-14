<?php

namespace App\Http\Resources;

use App\Data\DTO\AuthTokenDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    public readonly AuthTokenDTO $authTokenDTO;

    public function __construct($resource, AuthTokenDTO $authTokenDTO)
    {
        $this->authTokenDTO = $authTokenDTO;
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => new UserResource($this),
            'access' => $this->authTokenDTO
        ];
    }
}
