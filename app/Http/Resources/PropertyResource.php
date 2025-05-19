<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request) {
         return [
        'id' => $this->id,
        'price' => $this->price,
        'location' => $this->location,
        'description' => $this->description,
        'image_url' => $this->image ? asset('storage/' . $this->image) : null,
        'created_at' => $this->created_at->toDateTimeString(),
        'owner' => [
            'id' => $this->user->id,
            'name' => $this->user->name,
            'email' => $this->user->email,
        ]
    ];
    }
}
