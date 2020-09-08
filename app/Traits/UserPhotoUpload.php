<?php

namespace App\Traits;

use App\Photo;
use App\User;
use Illuminate\Http\Request;

trait UserPhotoUpload
{
    use BasePhotoUpload;
    
    public function storeUserPhoto(Request $request, User $user)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('users', 'public');
            if ($user->photo) {
                $photo = $this->getPhoto($user->photo->id);
                $this->deletePhotoFromStorageFolder($photo);
                $photo->path = $path;
                $user->photo()->save($photo);
            } else {
                $photo = new Photo();
                $photo->path = $path;
                $user->photo()->save($photo);
            }
        }
    }
}
