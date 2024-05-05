<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoachResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' =>$this->id,
            'name' => $this->name,
            'location' => $this->studio()->location,
            'image' => $this->getFirstMediaUrl('coaches'),
            'about' => $this->about,
            'experiences' => $this->experiences,
            'achievements' => $this->achievements,
            'studio_id' => $this->studio_id,
        ];
    }
}
