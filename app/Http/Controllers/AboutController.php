<?php

namespace App\Http\Controllers;

/**
 * Displays about page
 *
 * @return Response
 */
class AboutController extends Controller
{
    public function __invoke()
    {
        return view('about.index');
    }
}
