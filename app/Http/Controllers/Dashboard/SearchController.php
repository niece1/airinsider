<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\Dashboard\PostRepository;

class SearchController extends Controller
{
    /**
     * Display a listing of Post resource by search criteria.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $posts = PostRepository::search(request('keyword'));

        return view('dashboard.search.index', compact('posts'));
    }
}
