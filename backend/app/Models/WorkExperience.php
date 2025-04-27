<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WorkExperience extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    protected static function booted()
    {
        static::updating(function ($model) {
            if ($model->isDirty('work_experiences')) {
                $originalIcon = $model->getOriginal('work_experiences');
                if ($originalIcon && Storage::exists($originalIcon)) {
                    Storage::delete($originalIcon);
                }
            }
        });

        static::deleting(function ($model) {
            if ($model->thumbnail && Storage::exists($model->thumbnail)) {
                Storage::delete($model->thumbnail);
            }
        });
    }
}
