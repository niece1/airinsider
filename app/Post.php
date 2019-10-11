<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function photo()
    {
        return $this->morphOne('App\Photo', 'photoable');
    }
}
