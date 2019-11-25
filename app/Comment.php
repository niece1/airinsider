<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $with = ['user', 'likes'];

	protected $appends = ['repliesCount'];

	protected $guarded = [];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'comment_id')->whereNotNull('comment_id');
    }

    public function getRepliesCountAttribute()
    {
        return $this->replies->count();
    }

    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }
}
