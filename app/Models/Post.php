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
        'description',
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
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'publish_time'
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
        return is_null($this->publish_time) ? '' : $this->publish_time->diffForHumans();
    }

    /**
     * Get time in specific format.
     *
     * @return string
     */
    public function getPublishDateTimeAttribute()
    {
        setlocale(LC_TIME, config('app.locale'));
        return is_null($this->publish_time) ? '' : date('F j, G:i', strtotime($this->publish_time));
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getExcerptAttribute()
    {
        return $this->description ? substr(strip_tags(html_entity_decode($this->description)), 0, 95) : null;
    }

    /**
     * Get featured post description.
     *
     * @return string
     */
    public function getFeaturedExcerptAttribute()
    {
        return $this->description ? substr(strip_tags(html_entity_decode($this->description)), 0, 185) : null;
    }

    /**
     * Add 3 dots at the end of description.
     *
     * @return string
     */
    public function getThreeDotsAttribute()
    {
        return strlen(strip_tags(html_entity_decode($this->description))) > 85 ? " ..." : "";
    }

    /**
     * Add 3 dots at the end of featured post description.
     *
     * @return string
     */
    public function getFeaturedThreeDotsAttribute()
    {
        return strlen(strip_tags(html_entity_decode($this->description))) > 185 ? " ..." : "";
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
