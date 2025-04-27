<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
