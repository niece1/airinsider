<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Photo;
use App\Category;
use App\Tag;

class FrontendController extends Controller
{
    public function index()
    {
        $news = Post::with(['photo'])->orderBy('id', 'desc')->simplePaginate(12);

        return view('frontend.index', compact('news'));
    }

    public function show($slug)
    {
        $news_item = Post::with(['photo'])->where('slug', $slug)->firstOrFail();
        $news_item->viewedCounter();
        $related = Post::with(['photo'])->where('category_id', $news_item->category_id)->limit(4)->get();
        $categories = Category::with('posts')->get();
        $tags = Tag::all();

        return view('frontend.show', compact('news_item', 'categories', 'tags', 'related'));
    }
    
}
