<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];
    
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

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('comment_id')->orderBy('created_at', 'DESC');
    }

    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
