<?php

namespace App\Services;

use App\Photo;
use App\User;
use App\Traits\BasePhotoUpload;
use Illuminate\Http\Request;

/**
 * Save file to \storage\app\public\users
 *
 * @author Volodymyr Zhonchuk
 */
class UserPhotoUploader
{
    use BasePhotoUpload;
    
    /*
     * Store photo while creating/updating user profile
     *
     * @param  Illuminate\Http\Request $request
     * @param  \App\User $user
     *
     * @return void
     */
    public function store(Request $request, User $user)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('users', 'public');
            if ($user->photo) {
                $photo = $this->getPhoto($user->photo->id);
                $this->deletePhotoFromStorageFolder($photo);
                $photo->path = $path;
                $user->photo()->save($photo);
            }
            $photo = new Photo();
            $photo->path = $path;
            $user->photo()->save($photo);
        }
    }
}
