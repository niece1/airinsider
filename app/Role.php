<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\SyncPermissions;

class Role extends Model
{
    use SyncPermissions;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title'];
    
    /**
     * Get permissions associated with specified role
     *
     * @return BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }
    
    /**
     * Get users associated with specified role
     *
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
