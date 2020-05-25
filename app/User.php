<?php
namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\UserPhotoUpload;
use App\Traits\SyncRoles;

class User extends Authenticatable
{
    use Notifiable, UserPhotoUpload, SyncRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'last_login_at', 'password', 'last_login_ip_address', 'provider', 'provider_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function photo()
    {
        return $this->morphOne('App\Photo', 'photoable');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function toggleLike($entity, $type)
    {
        $like = $entity->likes->where('user_id', $this->id)->first();

        if ($like) {
            $like->update([
                'type' => $type
            ]);

            return $like->refresh();

        } else {
            return $entity->likes()->create([
                'type' => $type,
                'user_id' => $this->id
            ]);
        }
    }
}
