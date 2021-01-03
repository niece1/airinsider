<?php

namespace App\Services;

use App\Post;

/**
 * Save file to \storage\app\public\photos
 *
 * @author Volodymyr Zhonchuk
 */
final class PostPhotoUploadService extends PhotoUploadService
{
    /*
     * Get post namespace
     *
     * @param  Illuminate\Http\Request $request
     * @return string
     */
    public function getModelClass()
    {
        return Post::class;
    }
}
