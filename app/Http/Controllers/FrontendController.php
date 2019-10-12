<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Photo;

class FrontendController extends Controller
{
    public function index()
    {
        $news = Post::with(['photo'])->orderBy('id', 'desc')->get();
        return view('frontend.index', compact('news'));
    }
}
