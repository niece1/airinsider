<?php
namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class SearchController extends Controller {

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $posts = Post::with(['photo', 'category'])
                ->where('title', 'like', "%$keyword%")
                ->orWhere('body', 'like', "%$keyword%")
                ->limit(10)
                ->get();

        return view('backend.post.search-results', compact('posts'));
    }

}
