<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DeletePhoto;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photo extends Model
{
    use DeletePhoto;
    use HasFactory;

    /**
     * Get the owning photoable model.
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
