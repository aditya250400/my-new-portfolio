<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MediaSocial extends Model
{
    protected $guarded = [];

    public function biodata()
    {
        return $this->belongsTo(Biodata::class);
    }

    protected static function booted()
    {
        static::updating(function ($model) {
            if ($model->isDirty('icon')) {
                $originalIcon = $model->getOriginal('icon');
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
