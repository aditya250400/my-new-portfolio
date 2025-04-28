<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class BiodataFrontResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'nim' => $this->nim,
            'role' => $this->role,
            'headline' => $this->headline,
            'about_title' => $this->about_title,
            'about_content' => $this->about_content,
            'photo' => $this->photo ? Storage::url($this->photo) : null,
            'connection_description' => $this->connection_description,
        ];
    }
}
