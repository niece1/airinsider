<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SyncTags;
use App\Traits\SaveUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use SoftDeletes;
    use SyncTags;
    use SaveUser;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'slug',
        'user_id',
        'category_id',
        'published',
        'photo_source',
        'time_to_read',
    ];

    /**
     * Get photo associated with specified post
     */
    public function photo()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }

    /**
     * Get category record associated with specified post
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get user record associated with specified post
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get comments associated with specified post
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('comment_id')->orderBy('created_at', 'DESC');
    }

    /**
     * Get likes associated with specified post
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    /**
     * Get tags associated with specified post
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    /**
     * Get date in convenient for humans format
     *
     * @return string
     */
    public function getDateAttribute()
    {
        return is_null($this->updated_at) ? '' : $this->updated_at->diffForHumans();
    }

    /**
     * Get date in specific format
     *
     * @return string
     */
    public function getShowPageDateAttribute()
    {
        setlocale(LC_TIME, config('app.locale'));
        return is_null($this->updated_at) ? '' : strftime('%d %B %G года', strtotime($this->updated_at));
    }

    /**
     * Get time in specific format
     *
     * @return string
     */
    public function getShowPageTimeAttribute()
    {
        return is_null($this->updated_at) ? '' : date('H:i', strtotime($this->updated_at));
    }

    /**
     * Get body attribute, safe to publish
     *
     * @return string
     */
    public function getDashboardShowBodyAttribute()
    {
        return $this->body ? strip_tags(html_entity_decode($this->body)) : null;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescriptionAttribute()
    {
        return $this->body ? substr(strip_tags(html_entity_decode($this->body)), 0, 85) : null;
    }

    /**
     * Get featured post description
     *
     * @return string
     */
    public function getFeaturedDescriptionAttribute()
    {
        return $this->body ? substr(strip_tags(html_entity_decode($this->body)), 0, 185) : null;
    }

    /**
     * Add 3 dots at the end of description
     *
     * @return string
     */
    public function getThreeDotsAttribute()
    {
        return strlen(strip_tags(html_entity_decode($this->body))) > 85 ? " ..." : "";
    }

    /**
     * Add 3 dots at the end of featured post description
     *
     * @return string
     */
    public function getFeaturedThreeDotsAttribute()
    {
        return strlen(strip_tags(html_entity_decode($this->body))) > 185 ? " ..." : "";
    }

    /**
     * Add 'yes' if true and 'no' if false
     *
     * @return string
     */
    public function getIfPublishedAttribute()
    {
        return $this->published == 0 ? 'No' : 'Yes';
    }
}
