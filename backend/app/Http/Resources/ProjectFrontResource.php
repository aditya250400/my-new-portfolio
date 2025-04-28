<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProjectFrontResource extends JsonResource
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
            'slug' => $this->slug,
            'description' => $this->description,
            'start_date' => $this->start_date->format('d M Y'),
            'end_date' => $this->end_date ? $this->end_date->format('d M Y') : 'Sekarang',
            'difference_time' => $this->end_date ? Carbon::create($this->start_date)->diffInMonths(Carbon::create($this->end_date)) . ' Bulan' : 'Sekarang',
            'thumbnail' => $this->thumbnail ? Storage::url($this->thumbnail) : null,
            'website_link' => $this->website_link ? $this->website_link : null,
            'github_link' => $this->github_link ? $this->github_link : null,
            'skills' => $this->skills->map(function ($skill) {
                return [
                    'id' => $skill->id,
                    'name' => $skill->name,
                    'icon' => $skill->icon ? Storage::url($skill->icon) : null,
                ];
            }),

        ];
    }
}
