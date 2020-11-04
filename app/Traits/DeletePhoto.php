<?php

namespace App\Traits;

trait DeletePhoto
{
    use BasePhotoUpload;

    /**
     * Delete photo from database.
     *
     * @param int $id
     * @return void
     */
    public function deletePhoto($id)
    {
        $photo = $this->getPhoto($id);
        $this->deletePhotoFromStorageFolder($photo);
        $photo->delete($id);
    }
}
