<?php

namespace App\Http\Controllers\Dashboard;

use App\Tag;
use App\Http\Requests\TagRequest;
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
        abort_unless(\Gate::allows('tag_access'), 403);
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
        abort_unless(\Gate::allows('tag_create'), 403);
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
        abort_unless(\Gate::allows('tag_edit'), 403);

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
        abort_unless(\Gate::allows('tag_delete'), 403);
        TagRepository::delete($tag);

        return redirect('dashboard/tags')->withSuccessMessage('Tag Deleted Successfully!');
    }
}
