<?php

namespace App\Traits;

use App\Photo;
use Illuminate\Support\Facades\Storage;

trait BasePhotoUpload 
{
    private function getPhoto($id)
    {
        return Photo::find($id);
    }
    
    private function deletePhotoFromStorageFolder(Photo $photo)
    {
        return Storage::disk('public')->delete($photo->original_path);
    }
}
