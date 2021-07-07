<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Photo;

class PhotoController extends DashboardController
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function delete($id, Photo $photo)
    {
        $photo->deletePhoto($id);

        return redirect()->back()->withSuccessMessage('Photo Deleted!');
    }
}
