<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public function photoable()
    {
        return $this->morphTo();
    }

    public function getPublicpathAttribute($value)
    {
        return asset('storage/{$value}');
    }

    public function getStoragepathAttribute($value)
    {
        return $this->original['path'];
    }
}
