<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{    
    protected $fillable = ['title'];
	
    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
