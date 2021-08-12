<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title'];

    /**
     * Get posts associated with specified tag
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    /**
     * Get tag slug
     */
    public function getSlugAttribute()
    {
        return url("tags/{$this->id}-" . Str::slug($this->title));
    }
}
