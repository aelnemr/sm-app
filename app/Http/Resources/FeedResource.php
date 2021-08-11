<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class FeedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'color' => $this->color,
            'creator' => new UserProfileResource($this->creator),
            'body' => $this->body,
            'created_at' => $this->created_at->timestamp,
            'media' => $this->getMedia('posting')->toArray()
        ];
    }
}
