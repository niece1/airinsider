<?php

namespace App\Repositories\Dashboard;

use App\Models\Tag;
use App\Http\Requests\TagRequest;

/**
 * Tag entity database query class.
 *
 * @author Volodymyr Zhonchuk
 */
class TagRepository
{
    /**
     * Fetch all tags from the database.
     *
     * @return \App\Tag[]
     */
    public static function getAll()
    {
        return Tag::all();
    }

    /**
     * Save tag instance to the database.
     *
     * @param \App\Http\Requests\TagRequest  $request
     */
    public static function save(TagRequest $request)
    {
        Tag::create($request->all());
    }

    /**
     * Update tag instance in the database.
     *
     * @param \App\Http\Requests\TagRequest  $request
     * @param  \App\Tag  $tag
     */
    public static function update(TagRequest $request, Tag $tag)
    {
        $tag->update($request->all());
    }

    /**
     * Delete tag instance from the database.
     *
     * @param  \App\Tag  $tag
     */
    public static function delete(Tag $tag)
    {
        $tag->delete();
    }
}
