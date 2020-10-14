<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    
    /**
     * Get the owning likeable model
     *
     * @return MorphTo
     */
    public function likeable()
    {
        return $this->morphTo();
    }
}
