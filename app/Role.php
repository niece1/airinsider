<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\SyncPermissions;

class Role extends Model
{
    use SyncPermissions;
    
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
