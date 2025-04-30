<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class BlogFrontResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'thumbnail' => $this->thumbnail ? Storage::url($this->thumbnail) : null,
            'slug' => $this->slug,
            'created_at' => $this->created_at->format('d M, Y'),
            'category' =>  [
                'id' => $this->blogCategory?->id,
                'name' => $this->blogCategory?->name,
                'slug' => $this->blogCategory?->slug,
                'icon' => $this->blogCategory?->icon ? Storage::url($this->blogCategory->icon) : null,

            ],
        ];
    }
}
