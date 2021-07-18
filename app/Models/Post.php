<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SyncTags;
use App\Traits\SaveUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use DateTimeInterface;

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
        'publish_time',
    ];

    /**
     * Get photo associated with specified post.
     */
    public function photo()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }

    /**
     * Get category record associated with specified post.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get user record associated with specified post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get comments associated with specified post.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('comment_id')->orderBy('created_at', 'DESC');
    }

    /**
     * Get likes associated with specified post.
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    /**
     * Get tags associated with specified post.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    /**
     * Get date in convenient for humans format.
     *
     * @return string
     */
    public function getDateAttribute()
    {
        return is_null($this->updated_at) ? '' : $this->updated_at->diffForHumans();
    }

    /**
     * Get time in specific format.
     *
     * @return string
     */
    public function getPublishDateTimeAttribute()
    {
        setlocale(LC_TIME, config('app.locale'));
        return is_null($this->publish_time) ? '' : strftime('%d %B %G года, %H:%M', strtotime($this->publish_time));
    }

    /**
     * Get body attribute, safe to publish.
     *
     * @return string
     */
    public function getDashboardShowBodyAttribute()
    {
        return $this->body ? strip_tags(html_entity_decode($this->body)) : null;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescriptionAttribute()
    {
        return $this->body ? substr(strip_tags(html_entity_decode($this->body)), 0, 85) : null;
    }

    /**
     * Get featured post description.
     *
     * @return string
     */
    public function getFeaturedDescriptionAttribute()
    {
        return $this->body ? substr(strip_tags(html_entity_decode($this->body)), 0, 185) : null;
    }

    /**
     * Add 3 dots at the end of description.
     *
     * @return string
     */
    public function getThreeDotsAttribute()
    {
        return strlen(strip_tags(html_entity_decode($this->body))) > 85 ? " ..." : "";
    }

    /**
     * Add 3 dots at the end of featured post description.
     *
     * @return string
     */
    public function getFeaturedThreeDotsAttribute()
    {
        return strlen(strip_tags(html_entity_decode($this->body))) > 185 ? " ..." : "";
    }

    /**
     * Add 'yes' if true and 'no' if false.
     *
     * @return string
     */
    public function getIfPublishedAttribute()
    {
        return $this->published == 0 ? 'No' : 'Yes';
    }

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
