<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    /**
    * Displays about page.
    *
    * @return \Illuminate\Http\Response
    */
    public function __invoke()
    {
        return view('frontend.about.index');
    }
}
