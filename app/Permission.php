<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title'];

    /**
     * Get roles associated with specified permission
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
