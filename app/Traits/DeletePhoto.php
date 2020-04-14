<?php

namespace App\Traits;

trait DeletePhoto 
{    
    use BasePhotoUpload;
    
    public function deletePhoto($id)
    {
        $photo = $this->getPhoto($id);        
        $this->deletePhotoFromStorageFolder($photo);
        $photo->delete($id);
    }    
}