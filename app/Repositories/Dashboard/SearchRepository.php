<?php

namespace App\Repositories\Dashboard;

use App\Post;
use Illuminate\Http\Request;

/**
 * Search posts by the given query.
 *
 * @author Volodymyr Zhonchuk
 */
class SearchRepository
{
    /**
     * Fetch all posts from the database by the given query.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \App\Post[]
     */
    public static function search(Request $request)
    {
        $keyword = $request->input('keyword');
        
        return Post::with(['photo', 'category'])
                ->where('title', 'like', "%$keyword%")
                ->orWhere('body', 'like', "%$keyword%")
                ->limit(10)
                ->get();
    }
}
