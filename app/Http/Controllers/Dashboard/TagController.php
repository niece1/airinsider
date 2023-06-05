<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Tag;
use App\Http\Requests\Dashboard\TagRequest;
use App\Repositories\Dashboard\TagRepository;

class TagController extends DashboardController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Tag::class);
        $tags = TagRepository::getAll();

        return view('dashboard.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Tag::class);
        $tag = new Tag();

        return view('dashboard.tag.create', compact('tag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TagRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        $this->authorize('create', Tag::class);
        TagRepository::save($request);

        return redirect('dashboard/tags')->withSuccessMessage('Tag Created Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        $this->authorize('update', Tag::class);

        return view('dashboard.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TagRequest  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, Tag $tag)
    {
        $this->authorize('update', Tag::class);
        TagRepository::update($request, $tag);

        return redirect('dashboard/tags')->withSuccessMessage('Tag Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $this->authorize('delete', Tag::class);
        TagRepository::delete($tag);

        return redirect('dashboard/tags')->withSuccessMessage('Tag Deleted Successfully!');
    }
}
