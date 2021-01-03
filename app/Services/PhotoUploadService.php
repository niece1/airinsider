<?php

namespace App\Services;

use App\Photo;
use Illuminate\Http\Request;
use App\Traits\BasePhotoUpload;

/**
 * Save file to \storage\app\public\photos
 *
 * @author Volodymyr Zhonchuk
 */
abstract class PhotoUploadService
{
    use BasePhotoUpload;

    /**
     * Model instance.
     *
     * @var object
     */
    protected $model;

    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /*
     * Get model namespace
     *
     * @return string
     */
    abstract public function getModelClass();

    /*
     * Store photo while creating/updating post/user entity
     *
     * @param  Illuminate\Http\Request $request
     * @param  $model
     * @return void
     */
    public function store(Request $request, $model)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('photos', 'public');
            if ($model->photo) {
                $photo = $this->getPhoto($model->photo->id);
                $this->deletePhotoFromStorageFolder($photo);
                $photo->path = $path;
                $model->photo()->save($photo);
            }
            $photo = new Photo();
            $photo->path = $path;
            $model->photo()->save($photo);
        }
    }
}
