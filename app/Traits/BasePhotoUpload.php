<?php

namespace App\Traits;

use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

trait BasePhotoUpload
{
    /**
     * Get photo of specified resource.
     *
     * @param int $id
     * @return \App\Photo
     */
    private function getPhoto($id)
    {
        return Photo::find($id);
    }

    /**
     * Delete photo from folder.
     *
     * @param \App\Photo $photo
     * @return bool
     */
    private function deletePhotoFromStorageFolder(Photo $photo)
    {
        return Storage::delete($photo->original_path);
    }
}
