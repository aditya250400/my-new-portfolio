<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogCategory extends Model
{
    protected $guarded = [];

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }


    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    protected static function booted()
    {
        static::updating(function ($blogCategory) {
            if ($blogCategory->isDirty('icon')) {
                $originalIcon = $blogCategory->getOriginal('icon');
                if ($originalIcon && Storage::exists($originalIcon)) {
                    Storage::delete($originalIcon);
                }
            }
        });

        static::deleting(function ($blogCategory) {
            if ($blogCategory->icon && Storage::exists($blogCategory->icon)) {
                Storage::delete($blogCategory->icon);
            }
        });
    }
}
