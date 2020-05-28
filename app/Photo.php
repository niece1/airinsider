<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DeletePhoto;

class Photo extends Model
{
    use DeletePhoto;
            
    public function photoable()
    {
        return $this->morphTo();
    }

    public function getOriginalPathAttribute()
    {
        return $this->getOriginal('path');
    }
}
