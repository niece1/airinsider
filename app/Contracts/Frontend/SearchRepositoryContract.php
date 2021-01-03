<?php

namespace App\Contracts\Frontend;

interface SearchRepositoryContract
{
    /**
     * Display a listing of Post resource by search criteria.
     *
     * @param  $keyword
     * @return \Illuminate\Http\Response
     */
    public function search($keyword);
}
