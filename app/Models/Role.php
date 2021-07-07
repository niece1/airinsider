<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\SyncPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use SyncPermissions;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title'];

    /**
     * Get permissions associated with specified role
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }

    /**
     * Get users associated with specified role
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
