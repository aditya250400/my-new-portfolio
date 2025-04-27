<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Education extends Model
{
    protected $guarded = [];

    protected static function booted()
    {
        static::updating(function ($education) {
            if ($education->isDirty('icon')) {
                $originalIcon = $education->getOriginal('icon');
                if ($originalIcon && Storage::exists($originalIcon)) {
                    Storage::delete($originalIcon);
                }
            }
        });

        static::deleting(function ($education) {
            if ($education->icon && Storage::exists($education->icon)) {
                Storage::delete($education->icon);
            }
        });
    }
}
