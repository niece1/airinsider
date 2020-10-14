<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Dashboard\SearchRepository;

class SearchController extends Controller
{
    /**
     * Display a listing of Post resource by search criteria.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $posts = SearchRepository::search($request);

        return view('dashboard.search.search-results', compact('posts'));
    }
}
