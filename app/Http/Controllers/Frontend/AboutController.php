<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

/**
 * Displays about page
 *
 * @return Response
 */
class AboutController extends Controller
{
    public function __invoke()
    {
        return view('frontend.about.index');
    }
}
