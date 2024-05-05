<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudioResource extends JsonResource
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
            'image' => $this->getMedia('gym'),
            'location' => $this->location,
            'description' => $this->description,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'contact' => new ContactResource($this->contact)
        ];
    }
}
