<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
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
}
