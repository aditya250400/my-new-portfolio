<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Skill extends Model
{
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    protected static function booted()
    {
        static::updating(function ($model) {
            if ($model->isDirty('skills')) {
                $originalIcon = $model->getOriginal('skills');
                if ($originalIcon && Storage::exists($originalIcon)) {
                    Storage::delete($originalIcon);
                }
            }
        });

        static::deleting(function ($model) {
            if ($model->icon && Storage::exists($model->icon)) {
                Storage::delete($model->icon);
            }
        });
    }
}
