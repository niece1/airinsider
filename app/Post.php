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

    public function viewCounter()
    {
        $this->viewed += 1;
        $this->timestamps = false;
        return $this->save();
    }

    public function getDateAttribute()
    {
        return is_null($this->updated_at) ? '' : $this->updated_at->diffForHumans();
    }
    
    public function getShowPageDateAttribute()
    {
        return date('d-m-Y', strtotime($this->updated_at));
    }
    
    public function getDashboardShowBodyAttribute()
    {
        return $this->body ? strip_tags(html_entity_decode($this->body)) : NULL;
    }

    public function getDescriptionAttribute()
    {
        return $this->body ? substr(strip_tags(html_entity_decode($this->body)), 0, 85) : NULL;
    }
    
    public function getFeaturedDescriptionAttribute()
    {
        return $this->body ? substr(strip_tags(html_entity_decode($this->body)), 0, 185) : NULL;
    }
    
    public function getThreeDotsAttribute()
    {
        return strlen(strip_tags(html_entity_decode($this->body))) > 85 ? " ..." : "";
    }
    
    public function getFeaturedThreeDotsAttribute()
    {
        return strlen(strip_tags(html_entity_decode($this->body))) > 185 ? " ..." : "";
    }

    public function getIfPublishedAttribute()
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
