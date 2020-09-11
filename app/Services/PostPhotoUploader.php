<?php

namespace App\Services;

use App\Photo;
use App\Post;
use App\Traits\BasePhotoUpload;
use Illuminate\Http\Request;

/**
 * Save file to \storage\app\public\posts
 *
 * @author Volodymyr Zhonchuk
 */
class PostPhotoUploader
{
    use BasePhotoUpload;
    
    /*
     * Store photo while creating/updating post
     *
     * @param  Illuminate\Http\Request $request
     * @param  \App\Post $post
     *
     * @return void
     */
    public function store(Request $request, Post $post)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            if ($post->photo) {
                $photo = $this->getPhoto($post->photo->id);
                $this->deletePhotoFromStorageFolder($photo);
                $photo->path = $path;
                $post->photo()->save($photo);
            }
            $photo = new Photo();
            $photo->path = $path;
            $post->photo()->save($photo);
        }
    }
}
