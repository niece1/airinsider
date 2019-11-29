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
        $news = Post::with(['photo'])->orderBy('id', 'desc')->paginate(8);

        return view('frontend.index', compact('news'));
    }

    public function show($slug)
    {
        $post = Post::with(['photo'])->where('slug', $slug)->firstOrFail();
        $post->viewedCounter();
        $related = Post::with(['photo'])->where('category_id', $post->category_id)->limit(5)->get();
        $categories = Category::with('posts')->get();
        $tags = Tag::all();

        return view('frontend.show', compact('post', 'categories', 'tags', 'related'));
    }

    public function postsByCategory($category)
    {            
        $news_by_category = Post::with(['photo', 'category'])->where('category_id', $category)->orderBy('id', 'desc')->paginate(12);
        $category = Category::find($category);

        return view('frontend.category', compact('news_by_category', 'category'));
    }

    public function postsByTag($tag)
    {            
        $news_by_tag = Tag::find($tag)->posts()->orderBy('id', 'desc')->paginate(12);
        $tag = Tag::find($tag);

        return view('frontend.tag', compact('news_by_tag', 'tag'));
    }
    
}
