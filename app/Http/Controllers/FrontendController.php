<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Tag;
use App\User;

class FrontendController extends Controller
{
    public function index()
    {
        $featured = Post::with(['photo'])
        ->where('published', 1)
        ->orderBy('id', 'desc')
        ->first();

        $news = Post::with(['photo', 'category', 'user', 'comments'])
        ->where('published', 1)
        ->where('id', '<>', $featured->id)
        ->orderBy('id', 'desc')
        ->paginate(8);

        return view('frontend.index', compact('featured', 'news'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $post->viewCounter();

        $related = Post::with(['photo'])
        ->where('category_id', $post->category_id)
        ->where('published', 1)
        ->limit(5)
        ->get();

        $categories = Category::all();
        $tags = Tag::all();

        return view('frontend.show', compact('post', 'categories', 'tags', 'related'));
    }

    public function postsByCategory($category)
    {
        $news_by_category = Post::with(['photo', 'category', 'user', 'comments'])
        ->where('category_id', $category)
        ->where('published', 1)
        ->orderBy('id', 'desc')
        ->paginate(12);

        $category = Category::find($category);

        return view('frontend.category', compact('news_by_category', 'category'));
    }

    public function postsByTag($tag)
    {
        $news_by_tag = Tag::find($tag)->posts()->where('published', 1)->orderBy('id', 'desc')->paginate(12);
        $tag = Tag::find($tag);

        return view('frontend.tag', compact('news_by_tag', 'tag'));
    }

    public function postsByUser($user)
    {
        $news_by_user = Post::with(['photo', 'user', 'category', 'comments'])
        ->where('user_id', $user)
        ->where('published', 1)
        ->orderBy('id', 'desc')
        ->paginate(12);
        
        $user = User::find($user);

        return view('frontend.user', compact('news_by_user', 'user'));
    }
}
