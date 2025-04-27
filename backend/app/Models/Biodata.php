<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Biodata extends Model
{
    protected $guarded = [];

    public function biodata()
    {
        return $this->hasMany(MediaSocial::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::updating(function ($biodata) {
            if ($biodata->isDirty('photo')) {
                $originalIcon = $biodata->getOriginal('photo');
                if ($originalIcon && Storage::exists($originalIcon)) {
                    Storage::delete($originalIcon);
                }
            }
        });

        static::deleting(function ($biodata) {
            if ($biodata->photo && Storage::exists($biodata->photo)) {
                Storage::delete($biodata->photo);
            }
        });
    }
}
