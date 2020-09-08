<?php

namespace App\Traits;

use App\Photo;
use App\Post;
use Illuminate\Http\Request;

trait PostPhotoUpload
{
    use BasePhotoUpload;
    
    public function storePostPhoto(Request $request, Post $post)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            if ($post->photo) {
                $photo = $this->getPhoto($post->photo->id);
                $this->deletePhotoFromStorageFolder($photo);
                $photo->path = $path;
                $post->photo()->save($photo);
            } else {
                $photo = new Photo();
                $photo->path = $path;
                $post->photo()->save($photo);
            }
        }
    }
}
