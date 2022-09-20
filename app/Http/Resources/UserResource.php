<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        $user = $this->resource;

        return [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'year_of_birth' => $user->getYearOfBirth(),
            'created_at' => $user->getCreatedAt()
        ];
    }
}
