<?php

namespace App\Services;

use App\User;

/**
 * Save file to \storage\app\public\photos
 *
 * @author Volodymyr Zhonchuk
 */
final class UserPhotoUploader extends PhotoUploader
{
    /*
     * Get user namespace
     *
     * @param  Illuminate\Http\Request $request
     * @return string
     */
    public function getModelClass()
    {
        return User::class;
    }
}
