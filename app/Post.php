<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'body', 'slug', 'user_id', 'category_id', 'published', 'photo_source', 'time_to_read',
    ];
    
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
        $this->timestamps = false;
        return $this->save();
    }

    public function getDateAttribute($value)
    {
        return is_null($this->updated_at) ? '' : $this->updated_at->diffForHumans();
    }

    public function getHtmlBodyAttribute($value)
    {
        return $this->body ? strip_tags($this->body) : NULL;
    }

    public function getIfPublishedAttribute($value)
    {
        return $this->published == 0 ? 'No' : 'Yes';
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
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
}
