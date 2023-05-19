<?php

namespace App\Services;

use App\Models\Photo;
use App\Traits\DeletePhoto;

/**
 * Save file to s3 bucket.
 *
 * @author Volodymyr Zhonchuk
 */
abstract class PhotoUploadService
{
    use DeletePhoto;

    /**
     * Model to deal with.
     *
     * @var string
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
     * @param  $request
     * @param  $model
     * @return void
     */
    public function store($request, $model)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . $file->hashName();
            $path = $file->storeAs("images/{$this->getSubfolder()}", $fileName);

            if ($model->photo) {
                $this->deletePhoto($model->photo->id);
            }

            $photo = new Photo();
            $photo->path = $path;
            $model->photo()->save($photo);
        }
    }

    /*
     * Get model name subfolder.
     *
     * @return string
     */
    private function getSubfolder()
    {
        return strtolower(class_basename($this->getModelClass()));
    }
}
