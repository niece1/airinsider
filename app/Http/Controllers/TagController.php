<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Http\Requests\TagRequest;

class TagController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('tag_access'), 403);
        $tags = Tag::all();

        return view('backend.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(\Gate::allows('tag_create'), 403);
        $tags = new Tag();

        return view('backend.tag.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TagRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        Tag::create($request->all());

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

        return view('backend.tag.edit', compact('tag'));
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
        $tag->update($request->all());

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
        $tag->delete();

        return redirect('dashboard/tags')->withSuccessMessage('Tag Deleted Successfully!');
    }   
}
