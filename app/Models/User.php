<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\SyncRoles;
use App\Notifications\CustomResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;
    use SyncRoles;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'last_login_at',
        'password',
        'last_login_ip_address',
        'provider',
        'provider_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get photo associated with specified user
     */
    public function photo()
    {
        return $this->morphOne('App\Photo', 'photoable');
    }

    /**
     * Get posts associated with specified user
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get comments associated with specified user
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get roles associated with specified user
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    /**
     * Create or update like
     *
     * @param \App\Comment|\App\Post  $entity
     * @param string  $type
     * @return mixed
     */
    public function toggleLike($entity, $type)
    {
        $like = $entity->likes->where('user_id', $this->id)->first();
        if ($like) {
            $like->update(['type' => $type]);
            return $like->refresh();
        }
        return $entity->likes()->create([
            'type' => $type,
            'user_id' => $this->id,
        ]);
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPasswordNotification($token));
    }

    /**
     * Get user slug
     */
    public function getSlugAttribute()
    {
        return url("users/{$this->id}-" . Str::slug($this->name));
    }

    /**
     * Check if user has administrator rights.
     */
    public function getIsAdminAttribute()
    {
        foreach ($this->roles as $role) {
            if ($role->title === 'Admin') {
                return true;
            }
        }
    }
}
