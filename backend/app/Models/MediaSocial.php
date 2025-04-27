<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaSocial extends Model
{
    protected $guarded = [];

    public function biodata()
    {
        return $this->belongsTo(Biodata::class);
    }
}
