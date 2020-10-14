<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DeletePhoto;

class Photo extends Model
{
    use DeletePhoto;
    
    /**
     * Get the owning photoable model
     *
     * @return MorphTo
     */
    public function photoable()
    {
        return $this->morphTo();
    }
    
    /**
     * Get original photo path
     *
     * @return string
     */
    public function getOriginalPathAttribute()
    {
        return $this->getOriginal('path');
    }
}
