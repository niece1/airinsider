<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function photo()
    {
        return $this->morphOne('App\Photo', 'photoable');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function viewedCounter()
    {
        $this->viewed += 1;
        return $this->save();
    }
}
