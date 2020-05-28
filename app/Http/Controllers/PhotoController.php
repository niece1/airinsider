<?php

namespace App\Http\Controllers;

use App\Photo;

class PhotoController extends BackendController
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function expungePhoto($id, Photo $photo)
    {
        $photo->deletePhoto($id);
        
        return redirect()->back()->withSuccessMessage('Photo Deleted!');
    }
}
