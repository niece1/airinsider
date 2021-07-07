<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    /**
     * Default eager loaded relationship to fetch with every comment.
     *
     * @var array
     */
    protected $with = ['user', 'likes'];

    /**
     * The attribute to append the model's array.
     *
     * @var array
     */
    protected $appends = ['repliesCount'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get post record associated with specified comment
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Get user record associated with specified comment
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get replies associated with specified comment
     */
    public function replies()
    {
        return $this->hasMany(Comment::class, 'comment_id')->whereNotNull('comment_id');
    }

    /**
     * Get likes associated with specified comment
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    /**
     * Check wether comment has a reply
     *
     * @return string
     */
    public function getIfReplyAttribute()
    {
        return $this->comment_id == null ? 'No' : 'Yes';
    }

    /**
     * Count replies
     *
     * @return int
     */
    public function getRepliesCountAttribute()
    {
        return $this->replies->count();
    }
}
